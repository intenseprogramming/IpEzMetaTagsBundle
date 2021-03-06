<?php
/**
 * @category  PHP
 * @package   intense-programming
 * @version   1
 * @date      03/08/2015 18:50
 * @author    Konrad, Steve <skonrad@wingmail.net>
 * @copyright 2015 Intense-Programming
 */

namespace IntenseProgramming\EzMetaTagsBundle\Core\FieldType\IpEzMetaTags\MetaTagsStorage;

use eZ\Publish\Core\Persistence\Legacy\Content\FieldValue\Converter as ConverterInterface;
use eZ\Publish\Core\Persistence\Legacy\Content\StorageFieldDefinition;
use eZ\Publish\Core\Persistence\Legacy\Content\StorageFieldValue;
use eZ\Publish\SPI\Persistence\Content\FieldValue;
use eZ\Publish\SPI\Persistence\Content\Type\FieldDefinition;

/**
 * Class Converter.
 *
 * @package   IntenseProgramming\EzMetaTagsBundle\Core\FieldIpEzMetaTags\MetaTagsStorage
 * @author    Konrad, Steve <skonrad@wingmail.net>
 * @copyright 2015 Intense-Programming
 */
class Converter implements ConverterInterface
{
    /**
     * Converts data from $value to $storageFieldValue
     *
     * @param FieldValue        $value
     * @param StorageFieldValue $storageFieldValue
     */
    public function toStorageValue(FieldValue $value, StorageFieldValue $storageFieldValue)
    {
        $storageFieldValue->dataText = json_encode($value->data);
    }

    /**
     * Converts data from $value to $fieldValue
     *
     * @param StorageFieldValue $value
     * @param FieldValue        $fieldValue
     */
    public function toFieldValue(StorageFieldValue $value, FieldValue $fieldValue)
    {
        $fieldValue->data = json_decode($value->dataText, true);
    }

    /**
     * Converts field definition data in $fieldDef into $storageFieldDef
     *
     * @param FieldDefinition        $fieldDef
     * @param StorageFieldDefinition $storageDef
     */
    public function toStorageFieldDefinition(FieldDefinition $fieldDef, StorageFieldDefinition $storageDef)
    {
        $storageDef->dataText5 = serialize($fieldDef->fieldTypeConstraints->fieldSettings);
    }

    /**
     * Converts field definition data in $storageDef into $fieldDef
     *
     * @param StorageFieldDefinition $storageDef
     * @param FieldDefinition        $fieldDef
     */
    public function toFieldDefinition(StorageFieldDefinition $storageDef, FieldDefinition $fieldDef)
    {
        $fieldDef->fieldTypeConstraints->fieldSettings = unserialize($storageDef->dataText5);
    }

    /**
     * Returns the name of the index column in the attribute table
     *
     * Returns the name of the index column the datatype uses, which is either
     * "sort_key_int" or "sort_key_string". This column is then used for
     * filtering and sorting for this type.
     *
     * If the indexing is not supported, this method must return false.
     *
     * @return string|false
     */
    public function getIndexColumn()
    {
        return false;
    }

}
