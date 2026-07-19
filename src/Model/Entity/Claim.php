<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Claim Entity
 *
 * @property int $id
 * @property int $report_id
 * @property int $user_id
 * @property string $reason
 * @property string $contact_number
 * @property string|null $evidence
 * @property string $status
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\Report $report
 * @property \App\Model\Entity\User $user
 */
class Claim extends Entity
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
        'report_id' => true,
        'user_id' => true,
        'reason' => true,
        'contact_number' => true,
        'evidence' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'report' => true,
        'user' => true,
    ];
}
