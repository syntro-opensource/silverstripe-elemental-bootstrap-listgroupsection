<?php
namespace Syntro\SilverStripeElementalBootstrapListgroupSection\Model;

use SilverStripe\Forms\TextField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\TextareaField;
use SilverStripe\AssetAdmin\Forms\UploadField;
use Syntro\SilverStripeElementalBaseitems\Model\BaseItem;
use Syntro\SilverStripeElementalBootstrapListgroupSection\Elements\ListgroupSection;

/**
 * ListgroupItem
 *
 * @author Matthias Leutenegger <hello@syntro.ch>
 */
class ListgroupItem extends BaseItem
{
    /**
     * @var string
     */
    private static $table_name = 'ElementalBootstrapListgroupItem';

    /**
     * @var array
     */
    private static $db = [
        'Sort' => 'Int',
        'Content' => 'HTMLText',

    ];

    private static $default_sort = ['Sort' => 'ASC'];

    /**
     * @var array
     */
    private static $has_one = [
        'Section' => ListgroupSection::class,
        'Image' => Image::class,
    ];

    /**
     * @var array
     */
    private static $owns = [
        'Image'
    ];

    private static $defaults = [
        'ShowTitle' => true
    ];

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function ($fields) {
            /** @var FieldList $fields */
            $fields->removeByName([
                'Sort',
                'SectionID',
            ]);

            // Add Image Upload Field
            $fields->addFieldToTab(
                'Root.Main',
                $imageField = UploadField::create(
                    'Image',
                    'Image'
                ),
                'Content'
            );
            $imageField->setFolderName('Uploads/ListgroupItems');

            // Add content field
            // $fields->addFieldToTab(
            //     'Root.Main',
            //     TextareaField::create(
            //         'Content',
            //         'Content'
            //     ),
            //     'CTALink'
            // );
        });

        return parent::getCMSFields();
    }
}
