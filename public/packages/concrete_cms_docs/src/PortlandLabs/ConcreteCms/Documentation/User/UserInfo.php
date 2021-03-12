<?php /** @noinspection ALL */

/**
 * @project:   ConcreteCMS Documentation
 *
 * @copyright  (C) 2021 Portland Labs (https://www.portlandlabs.com)
 * @author     Fabian Bitter (fabian@bitter.de)
 */

namespace PortlandLabs\ConcreteCms\Documentation\User;

use Concrete\Core\User\UserInfo as CoreUserInfo;
use League\Url\Url;

class UserInfo extends CoreUserInfo
{
    protected $communityUserID;

    public function getUserCommunityUserID()
    {
        if (!isset($this->communityUserID)) {
            /** @noinspection PhpUnhandledExceptionInspection */
            /** @noinspection SqlDialectInspection */
            /** @noinspection SqlNoDataSourceInspection */
            $this->communityUserID = $this->connection->fetchColumn('select binding from OauthUserMap where user_id = ?', array(
                $this->getUserID()
            ));
        }

        return $this->communityUserID;
    }

    public function getUserPublicProfileUrl()
    {
        if ($this->getUserCommunityUserID()) {
            $url = Url::createFromUrl("https://www.concretecms.org/profile/-/view");
            $path = $url->getPath();
            $path->append((string)$this->getUserCommunityUserID());
            return $url->setPath($path);
        }
    }
}