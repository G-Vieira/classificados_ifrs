<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Anuncio Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $categoria_id
 * @property string $descricao
 * @property string $titulo
 * @property double $preco
 * @property \Cake\I18n\FrozenDate $validade
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Categoria $categoria
 * @property \App\Model\Entity\Anexo[] $anexos
 * @property \App\Model\Entity\Comentario[] $comentarios
 */
class Anuncio extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'user_id' => true,
        'categoria_id' => true,
        'descricao' => true,
        'titulo' => true,
        'preco' => true,
        'validade' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'categoria' => true,
        'imagem' => true,
        'anexos' => true,
        'comentarios' => true
    ];
}
