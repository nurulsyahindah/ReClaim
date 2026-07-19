<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AdminNotifications Model
 *
 * @method \App\Model\Entity\AdminNotification newEmptyEntity()
 * @method \App\Model\Entity\AdminNotification newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\AdminNotification> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AdminNotification get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\AdminNotification findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\AdminNotification patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\AdminNotification> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\AdminNotification|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\AdminNotification saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\AdminNotification>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\AdminNotification>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\AdminNotification>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\AdminNotification> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\AdminNotification>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\AdminNotification>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\AdminNotification>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\AdminNotification> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AdminNotificationsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('admin_notifications');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('title')
            ->maxLength('title', 100)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('message')
            ->requirePresence('message', 'create')
            ->notEmptyString('message');

        $validator
            ->scalar('category')
            ->requirePresence('category', 'create')
            ->notEmptyString('category');

        $validator
            ->scalar('is_read')
            ->allowEmptyString('is_read');

        return $validator;
    }
}
