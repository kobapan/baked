<?php
App::uses('BlockAppModel', 'Model');

class BlockPhotoGallery extends BlockAppModel
{
  public $name = 'BlockPhotoGallery';
  public $valid = array(
    'add' => array(
      'slider_animation' => 'required | inClassArrayKeys[SLIDER_ANIMATION]',
      'slider_theme' => 'required | inClassArrayKeys[SLIDER_THEME]',
      'slider_pause_time' => 'required | inClassArrayKeys[SLIDER_PAUSE_TIME]'
    ),
    'update' => array(
      'id' => 'required | isExist'
    ),
  );
  public $columnLabels = array();
  public static $SLIDER_THEME = array();
  public static $SLIDER_ANIMATION = array();
  public static $SLIDER_PAUSE_TIME = array();

  public function __construct($id = false, $table = null, $ds = null)
  {
    parent::__construct($id, $table, $ds);

    self::$SLIDER_THEME = array(
      'default' => __('Theme: Default'),
      'bar' => __('Theme: Bar'),
      'dark' => __('Theme: Dark'),
      'light' => __('Theme: Light'),
    );

    self::$SLIDER_ANIMATION = array(
      'sliceDown' => __('Animation: sliceDown'),
      'sliceDownLeft' => __('Animation: sliceDownLeft'),
      'sliceUp' => __('Animation: sliceUp'),
      'sliceUpLeft' => __('Animation: sliceUpLeft'),
      'sliceUpDown' => __('Animation: sliceUpDown'),
      'sliceUpDownLeft' => __('Animation: sliceUpDownLeft'),
      'fold' => __('Animation: fold'),
      'fade' => __('Animation: fade'),
      'random' => __('Animation: random'),
      'slideInRight' => __('Animation: slideInRight'),
      'slideInLeft' => __('Animation: slideInLeft'),
      'boxRandom' => __('Animation: boxRandom'),
      'boxRain' => __('Animation: boxRain'),
      'boxRainReverse' => __('Animation: boxRainReverse'),
      'boxRainGrow' => __('Animation: boxRainGrow'),
      'boxRainGrowReverse' => __('Animation: boxRainGrowReverse'),
    );

    self::$SLIDER_PAUSE_TIME = array(
      1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10,
    );

    $this->columnLabels = array(
    );
  }

/**
 * Return initiali data
 *
 * @return mixed array on success. true to ignore. false to occur error.
 */
  public function initialData()
  {
    return array(
      'type' => 'lightbox',
      'width' => 80,
      'photos' => array(),
      'slider_pause_time' => 3,
      'slider_animation' => 'random',
      'slider_theme' => 'default',
    );
  }

/**
 * Callback before delete.
 *
 * @param int $blockId
 * @return boolean
 */
  public function willDelete($blockId)
  {
    try {
      $data = $this->getData($blockId);
      if (empty($data)) throw new Exception(__('Not found block.'));

      foreach ($data['photos'] as $fileId => $photo) {
        $r = $this->deletePhoto($blockId, $fileId);
        if ($r !== TRUE) throw new Exception('Failed to delete photo.');
      }

      return TRUE;
    } catch (Exception $e) {
      return FALSE;
    }
  }

/**
 * Save photos sort.
 *
 * @param int $blockId
 * @param array $fileIds
 * @return boolean
 */
  public function saveSort($blockId, $fileIds)
  {
    try {
      $this->begin();
      $this->loadModel('File');

      $data = $this->getData($blockId);
      if (empty($data)) throw new Exception('Not found block.');

      $newPhotos = array();
      foreach ($fileIds as $fileId) {
        $newPhotos[$fileId] = $data['photos'][$fileId];
      }
      $data['photos'] = $newPhotos;

      $r = $this->updateData($blockId, $data);
      if ($r !== TRUE) throw $r;

      $this->commit();
      return TRUE;
    } catch (Exception $e) {
      $this->rollback();
      return FALSE;
    }
  }

/**
 * Delete photo.
 *
 * @param int $blockId
 * @param int $fileId
 * @return boolean
 */
  public function deletePhoto($blockId, $fileId)
  {
    try {
      $this->begin();
      $this->loadModel('File');

      $data = $this->getData($blockId);
      $deleted = FALSE;

      foreach ($data['photos'] as $key => $photo) {
        if ($photo['file_id'] == $fileId) {
          $r = $this->File->delete($fileId);
          if ($r === TRUE) {
            $deleted = TRUE;
            unset($data['photos'][$key]);
          }
          break;
        }
      }

      if ($deleted === FALSE) {
        throw new Exception(__('Failed to delete file.'));
      }

      $r = $this->updateData($blockId, $data);
      if ($r !== TRUE) throw $r;

      $this->commit();
      return TRUE;
    } catch (Exception $e) {
      $this->rollback();
      return FALSE;
    }
  }

}



