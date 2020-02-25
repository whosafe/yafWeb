<?php
/**
 * Created by PhpStorm.
 *
 * @author 曾洪亮<zenghongl@126.com>
 * @email  zenghongl@126.com
 * User: whosafe
 * Date: 2018/6/25
 * Time: 上午11:24
 */

/**
 *  */
class IndexController extends Base\BaseControllers
{
 
    public function indexAction(){

        $data = PokerModel::instance()->getList();

        $this->assign('data',$data);
        $this->assign('pokerTypeStr', $this->pokerTypeStrOne);
        $this->assign('pokerList', $this->pokerList);
    }

}
