<?php

namespace Syntro\SilverStripeElementalBootstrapListgroupSection\Elements;

use SilverStripe\Forms\TextField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\ORM\FieldType\DBField;
use SilverStripe\ORM\FieldType\DBHTMLText;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldAddExistingAutocompleter;
use SilverStripe\Forms\GridField\GridFieldDeleteAction;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;
use SilverStripe\Forms\GridField\GridFieldDetailForm;
use DNADesign\Elemental\Models\BaseElement;
use Syntro\SilverStripeElementalBootstrapListgroupSection\Model\ListgroupItem;

/**
 *  Bootstrap based Listgroup section
 *
 * @author Matthias Leutenegger <hello@syntro.ch>
 */
class ListgroupSection extends BaseElement
{

    private static $icon = 'elemental-icon-listgroup';
    /**
     * This defines the block name in the CSS
     *
     * @config
     * @var string
     */
    private static $block_name = 'listgroup-section';

    /**
     * @var bool
     */
    private static $inline_editable = false;

    private static $styles = [];

    /**
     * @var string
     */
    // private static $icon = 'font-icon-attention';

    /**
     * @var string
     */
    private static $table_name = 'ElementListgroupSection';

    /**
     * set to false if image option should not show up
     *
     * @config
     * @var bool
     */
    private static $allow_image_background = true;

    /**
     * Available background colors for this Element
     *
     * @config
     * @var array
     */
    private static $background_colors = [];

    /**
     * Color mapping from background color. This is mainly intended
     * to set a default color on the section-level, ensuring text is readable.
     * Colors of subelementscan be added via templates
     *
     * @config
     * @var array
     */
    private static $text_colors_by_background = [];

    private static $db = [
        'Content' => 'Text',
    ];

    private static $has_many = [
        'ListgroupItems' => ListgroupItem::class
    ];

    /**
     * fieldLabels - apply labels
     *
     * @param  boolean $includerelations = true
     * @return array
     */
    public function fieldLabels($includerelations = true)
    {
        $labels = parent::fieldLabels($includerelations);
        $labels['ListgroupItems'] = _t(__CLASS__ . '.LISTITEMS', 'List items');
        $labels['Content'] = _t(__CLASS__ . '.CONTENT', 'Content');
        return $labels;
    }

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function ($fields) {

            $fields->dataFieldByName('Content')->setTitle($this->fieldLabel('Content'));

            if ($this->ID) {
                /** @var GridField $items */
                $items = $fields->dataFieldByName('ListgroupItems');
                $items->setTitle($this->fieldLabel('ListgroupItems'));

                $fields->removeByName('ListgroupItems');

                $config = $items->getConfig();
                $config->addComponent(new GridFieldOrderableRows('Sort'));
                $config->removeComponentsByType(GridFieldAddExistingAutocompleter::class);
                $config->removeComponentsByType(GridFieldDeleteAction::class);


                $fields->addFieldToTab('Root.Main', $items);
            }
        });

        return parent::getCMSFields();
    }

    /**
     * @return string
     */
    public function getSummary()
    {
        return sprintf(
            '%s: "%s"',
            _t(
                __CLASS__ . '.SUMMARY',
                'one item|{count} items',
                ['count' => $this->ListgroupItems()->count()]
            ),
            implode('", "', $this->ListgroupItems()->map('Title')->keys())
        );
    }

    /**
     * @return array
     */
    protected function provideBlockSchema()
    {
        $blockSchema = parent::provideBlockSchema();
        $blockSchema['content'] = $this->getSummary();
        return $blockSchema;
    }

    /**
     * getType - get type
     *
     * @return string
     */
    public function getType()
    {
        return _t(__CLASS__ . '.BlockType', 'Listgroup Section');
    }
}
