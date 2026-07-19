<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Claims Model
 *
 * @property \App\Model\Table\ReportsTable&\Cake\ORM\Association\BelongsTo $Reports
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Claim newEmptyEntity()
 * @method \App\Model\Entity\Claim newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Claim> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Claim get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Claim findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Claim patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Claim> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Claim|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Claim saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Claim>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Claim>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Claim>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Claim> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Claim>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Claim>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Claim>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Claim> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ClaimsTable extends Table
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

        $this->setTable('claims');
        $this->setDisplayField('reason');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Reports', [
            'foreignKey' => 'report_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
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
            ->integer('report_id')
            ->notEmptyString('report_id');

        $validator
            ->integer('user_id')
            ->notEmptyString('user_id');

        $validator
            ->scalar('reason')
            ->maxLength('reason', 500)
            ->requirePresence('reason', 'create')
            ->notEmptyString('reason');

        $validator
            ->scalar('contact_number')
            ->maxLength('contact_number', 20)
            ->requirePresence('contact_number', 'create')
            ->notEmptyString('contact_number');

        $validator
    ->scalar('evidence')
    ->maxLength('evidence', 255)
    ->allowEmptyFile('evidence');

        $validator
    ->scalar('status')
    ->allowEmptyString('status');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['report_id'], 'Reports'), ['errorField' => 'report_id']);
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}