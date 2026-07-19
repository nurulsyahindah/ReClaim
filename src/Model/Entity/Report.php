<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Report Entity
 *
 * @property int $id
 * @property string $report_code
 * @property int $user_id
 * @property int $category_id
 * @property string $type
 * @property string $item_name
 * @property string $description
 * @property string $location
 * @property \Cake\I18n\Date $report_date
 * @property string $contact_number
 * @property string|null $image
 * @property string $status
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Category $category
 * @property \App\Model\Entity\Claim[] $claims
 */
class Report extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'report_code' => true,
        'user_id' => true,
        'category_id' => true,
        'type' => true,
        'item_name' => true,
        'description' => true,
        'location' => true,
        'report_date' => true,
        'contact_number' => true,
        'image' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'category' => true,
        'claims' => true,
    ];
}
