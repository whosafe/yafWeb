<?php
/**
 * Created by PhpStorm.
 *
 * @author 曾洪亮<zenghongl@126.com>
 * @email  zenghongl@126.com
 * User: whoSafe
 * Date: 2018/7/2
 * Time: 上午11:32
 */

/**
 *  */
class UserModel extends \Base\BaseModels
{

    /**
     * 获取用户列表.
     *
     * @Author : whoSafe
     *
     * @param int $offset 便宜量.
     * @param int $limit  获取条数.
     *
     * @return array
     */
    public function getUserList(int $offset, int $limit): array
    {
        $db    = $this->getDataBase();
        $sql   = 'SELECT id,user_name,user_real,level,create_time,update_time,state FROM user ORDER BY id DESC LIMIT :offset,:limit';
        $query = [
            ':offset' => $offset,
            ':limit'  => $limit,
        ];

        return $db->createSql($sql)
            ->query($query)
            ->fetchAll();

    }

    /**
     * 根据id获取一条数据.
     *
     * @Author : whoSafe
     *
     * @param int $id 用户id.
     *
     * @return array
     */
    public function getRowById(int $id): array
    {
        $db    = $this->getDataBase();
        $sql   = 'SELECT id,user_name,user_real,level,create_time,update_time,state FROM user WHERE id = :id ';
        $query = [
            ':id' => $id,
        ];
        $data  = $db->createSql($sql)
            ->query($query)
            ->fetch();

        return $data ?? [];
    }

    /**
     * 根据用户名获取一条数据.
     *
     * @Author : whoSafe
     *
     * @param string $userName 用户名称.
     *
     * @return array
     */
    public function getRowByUserName(string $userName): array
    {
        $db    = $this->getDataBase();
        $sql   = 'SELECT id,user_name,password,user_real,level,create_time,update_time,state FROM user WHERE user_name = :userName ';
        $query = [
            ':userName' => $userName,
        ];
        $data  = $db->createSql($sql)
            ->query($query)
            ->fetch();

        return $data ?? [];
    }

    /**
     * 根据id更新用户密码.
     *
     * @Author : whoSafe
     *
     * @param int    $id       用户Id.
     * @param string $password 用户密码.
     *
     * @return mixed
     */
    public function putPasswordById(int $id, string $password): int
    {
        $newPassword = $this->passwordEncryption($password);

        $db    = $this->getDataBase(false);
        $sql   = 'UPDATE user SET password = :password,update_time = :updateTime WHERE id = :id';
        $query = [
            ':password'   => $newPassword,
            ':id'         => $id,
            ':updateTime' => date('Y-m-d H:i:s')
        ];

        return $db->createSql($sql)
            ->query($query)
            ->rowCount();

    }

    /**
     * 添加用户.
     *
     * @Author : whoSafe
     *
     * @param string $userName 用户名.
     * @param string $userReal 用户真实姓名.
     * @param string $password 用户登录密码.
     * @param int    $level    用户级别.
     *
     * @return int
     */
    public function addUser(string $userName, string $userReal, string $password, int $level): int
    {
        $db       = $this->getDataBase(false);
        $sql      = 'INSERT INTO user(user_name,user_real,password,level,state,create_time,update_time) VALUE(:userName,:userReal,:password,:level,:state,:createTime,:updateTime)';
        $dateTime = date('Y-m-d H:i:s');
        $query    = [
            ':userName'   => $userName,
            ':userReal'   => $userReal,
            ':password'   => $this->passwordEncryption($password),
            ':level'      => $level,
            ':state'      => 1,
            ':createTime' => $dateTime,
            ':updateTime' => $dateTime,
        ];

        return $db->createSql($sql)
            ->query($query)
            ->lastInsertId();

    }

}
