<?php
App::uses('BlockPhotoGalleryAppModel', 'BlockPhotoGallery.Model');

class BlockPhotoGallery extends BlockPhotoGalleryAppModel
{
  public $name = 'BlockPhotoGallery';
  public $valid = array(
    'add' => array(
    ),
    'update' => array(
      'id' => 'required | isExist'
    ),
  );
  public $columnLabels = array();

  public function __construct($id = false, $table = null, $ds = null)
  {
    parent::__construct($id, $table, $ds);
    $this->columnLabels = array(
    );
  }

  public function convert($block)
  {
    return $block;
  }

/**
 * Return initiali data
 *
 * @return mixed array on success. true to ignore. false to occur error.
 */
  public function initialData()
  {
    return array(
      'width'  => 80,
      'photos' => array(),
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

  public function insert()
  {
  }

}



