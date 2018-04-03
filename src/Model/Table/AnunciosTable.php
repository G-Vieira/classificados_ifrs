<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Anuncios Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\CategoriasTable|\Cake\ORM\Association\BelongsTo $Categorias
 * @property \App\Model\Table\AnexosTable|\Cake\ORM\Association\HasMany $Anexos
 * @property \App\Model\Table\ComentariosTable|\Cake\ORM\Association\HasMany $Comentarios
 *
 * @method \App\Model\Entity\Anuncio get($primaryKey, $options = [])
 * @method \App\Model\Entity\Anuncio newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Anuncio[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Anuncio|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Anuncio patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Anuncio[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Anuncio findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AnunciosTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('anuncios');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Categorias', [
            'foreignKey' => 'categoria_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Anexos', [
            'foreignKey' => 'anuncio_id'
        ]);
        $this->hasMany('Comentarios', [
            'foreignKey' => 'anuncio_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('descricao')
            ->requirePresence('descricao', 'create')
            ->notEmpty('descricao');

        $validator
            ->scalar('titulo')
            ->maxLength('titulo', 50)
            ->requirePresence('titulo', 'create')
            ->notEmpty('titulo');

        $validator
            ->date('validade')
            ->requirePresence('validade', 'create')
            ->notEmpty('validade');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['categoria_id'], 'Categorias'));

        return $rules;
    }
}
