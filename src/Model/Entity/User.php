<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
/**
 * User Entity
 *
 * @property int $id
 * @property string $name
 * @property string $student_id
 * @property string $email
 * @property string $password
 * @property string $role
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\Claim[] $claims
 * @property \App\Model\Entity\Notification[] $notifications
 * @property \App\Model\Entity\Report[] $reports
 */
class User extends Entity
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
        'name' => true,
        'student_id' => true,
        'email' => true,
        'password' => true,
        'role' => true,
        'created' => true,
        'modified' => true,
        'claims' => true,
        'notifications' => true,
        'reports' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array<string>
     */
    protected array $_hidden = [
        'password',
    ];

    /**
     * Is called before the entity is saved to hash the password.
     *
     * @param string $password The password to hash.
     * @return string The hashed password.
     */
    
    protected function _setPassword(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}
