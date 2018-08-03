<?php
/**
 * @author ambi
 * @date 2018/8/3
 */

namespace Janice\Validator;


use Janice\Exception\LoveException;
use Janice\Library\JaniceMessage;
use Janice\Validation;

class File extends Validator
{
    public function validator(Validation $validation, $field)
    {
        $value = $validation->getValue($field);
        $multiFile = $this->diverseArray($value);
        $code = $this->getCode();
        $message = $this->getMessage($field);
        $success = true;
        foreach ($multiFile as $fileInfo) {
            if ($this->isAllowEmpty() && !$fileInfo) {
                continue;
            }
            if (!is_array($fileInfo)) {
                $validation->appendMessage(new JaniceMessage($code, $message));
                $success = false;
            }
            !$this->validateError($validation, $fileInfo) && $success = false;//验证错误码
            !$this->validateMaxSize($validation, $fileInfo) && $success = false;//验证文件大小
            !$this->validateType($validation, $fileInfo) && $success = false;//验证文件类型
        }
        return $success;
    }

    public function validateType(Validation $validation, $value)
    {
        $allowTypeList = $this->getOption('allowType');
        if (empty($allowTypeList)) {
            return true;
        }
        if (!is_array($allowTypeList)) {
            $allowTypeList = [$allowTypeList];
        }
        $fileType = isset($value['type']) ? $value['type'] : '';
        if (in_array($fileType, $allowTypeList)) {
            return true;
        }
        $message = $this->getOption('messageType');
        !$message && $message = ':fileType 不在允许的文件类型列表内';
        $message = str_replace(':fileType', $fileType, $message);
        $validation->appendMessage(new JaniceMessage($this->getCode(), $message));
        return false;
    }

    private function validateMaxSize(Validation $validation, $value)
    {
        $rawMaxSize = $this->getOption('maxSize');
        if (!$rawMaxSize) {
            return true;
        }
        $maxSize = intval($rawMaxSize);
        $unit = substr($rawMaxSize, strlen($maxSize));
        switch (strtoupper($unit)) {
            case 'B':
                break;
            case 'K':
            case 'KB':
                $maxSize = $maxSize * 1024;
                break;
            case 'M':
            case 'MB':
                $maxSize = $maxSize * 1024 * 1024;
                break;
            default:
                throw new LoveException('maxSize格式为[数字b|kb|k|mb|m]，字母单位不区分大小写');
        }
        $fileSize = isset($value['size']) ? $value['size'] : 0;
        if ($fileSize <= $maxSize) {
            return true;
        }
        $message = $this->getOption('messageSize');
        !$message && $message = '文件最大尺寸限制为 :maxSize';
        $message = str_replace(':maxSize', $rawMaxSize, $message);
        $validation->appendMessage(new JaniceMessage($this->getCode(), $message));
        return false;
    }

    private function validateError(Validation $validation, $value)
    {
        if (!isset($value['error'])) {
            return true;
        }
        $code = $value['error'];
        $message = '';
        switch ($value['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_INI_SIZE:
                $message = '上传的文件大小超过ini文件的限定';
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $message = '上传的文件超过MAX_FILE_SIZE限定';
                break;
            case UPLOAD_ERR_PARTIAL:
                $message = '上传的文件不完整';
                break;
            case UPLOAD_ERR_NO_FILE:
                $message = '未选择上传的文件';
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $message = '缓存文件夹不存在';
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $message = '缓存文件写入失败';
                break;
            case UPLOAD_ERR_EXTENSION:
                $message = '未知文件扩展导致处理失败';
                break;
            default:
                $message = "未知错误【{$value['error']}】";
        }
        if ($code) {
            $validation->appendMessage(new JaniceMessage($this->getCode(), $message));
        }
        return false;
    }

    private function diverseArray($vector)
    {
        $result = array();
        foreach ($vector as $key1 => $value1) {
            if (!is_array($value1)) {
                return [$vector];
            }
            foreach ($value1 as $key2 => $value2) {
                $result[$key2][$key1] = $value2;
            }
        }
        return $result;
    }

}