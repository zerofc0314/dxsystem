<?php

/**
 * 分页行为扩展
 *
 * @author KingStar
 */
class CPage extends Page {

    protected $config = array(
        'header' => '条记录',
        'prev' => '上一页',
        'next' => '下一页',
        'first' => '第一页',
        'last' => '最后一页',
        'theme' => ' 
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td>&nbsp;&nbsp;共 %totalRow% 条记录，当前第  %nowPage% / %totalPage%  页</td>
                    <td><table border="0" align="right" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="40">
                                    %first%
                                </td>
                                <td width="45">
                                    %upPage%
                                </td>
                                <td width="45">
                                %linkPage% 
                                </td>
                                <td width="45">
                                    %downPage%
                                </td>
                                <td width="40">
                                    %end%
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table> ');

    /*
     * 分页显示输出（重构分页）
     * @access public
     */

    public function show() {
        if (0 == $this->totalRows)
            return '';
        $p = $this->varPage;
        $nowCoolPage = ceil($this->nowPage / $this->rollPage);

        // 分析分页参数
        if ($this->url) {
            $depr = C('URL_PATHINFO_DEPR');
            $url = rtrim(U('/' . $this->url, '', false), $depr) . $depr . '__PAGE__';
        } else {
            if ($this->parameter && is_string($this->parameter)) {
                parse_str($this->parameter, $parameter);
            } elseif (is_array($this->parameter)) {
                $parameter = $this->parameter;
            } elseif (empty($this->parameter)) {
                unset($_GET[C('VAR_URL_PARAMS')]);
                $var = !empty($_POST) ? $_POST : $_GET;
                if (empty($var)) {
                    $parameter = array();
                } else {
                    $parameter = $var;
                }
            }
            $parameter[$p] = '__PAGE__';
            $url = U('', $parameter);
        }
        //上下翻页字符串
        $upRow = $this->nowPage - 1;
        $downRow = $this->nowPage + 1;
        if ($upRow > 0) {
            $upPage = "<a href='" . str_replace('__PAGE__', $upRow, $url) . "'>" . '<img src="./Tpl/static/images/back.gif" width="43" height="15" />' . "</a>";
        } else {
            $upPage = '';
        }

        if ($downRow <= $this->totalPages) {
            $downPage = "<a href='" . str_replace('__PAGE__', $downRow, $url) . "'>" .'<img src="./Tpl/static/images/next.gif" width="43" height="15" />' . "</a>";
        } else {
            $downPage = '';
        }
        // << < > >>
        if ($nowCoolPage == 1) {
            $theFirst = '';
            $prePage = '';
        } else {
            $preRow = $this->nowPage - $this->rollPage;
            $prePage = "<a href='" . str_replace('__PAGE__', $preRow, $url) . "' >上" . $this->rollPage . "页</a>";
        }
        $theFirst = "<a href='" . str_replace('__PAGE__', 1, $url) . "' >" . '<img src="./Tpl/static/images/first.gif" width="37" height="15" />' . "</a>";
        if ($nowCoolPage == $this->coolPages) {
            $nextPage = '';
            $theEnd = '';
        } else {
            $nextRow = $this->nowPage + $this->rollPage;
            $theEndRow = $this->totalPages;
            $nextPage = "<a href='" . str_replace('__PAGE__', $nextRow, $url) . "' >下" . $this->rollPage . "页</a>";
            $theEnd = "<a href='" . str_replace('__PAGE__', $theEndRow, $url) . "' >" .'<img src="./Tpl/static/images/last.gif" width="37" height="15" />' . "</a>";
        }
        // 1 2 3 4 5
        $linkPage = "";
        for ($i = 1; $i <= $this->rollPage; $i++) {
            $page = ($nowCoolPage - 1) * $this->rollPage + $i;
            if ($page != $this->nowPage) {
                if ($page <= $this->totalPages) {
                    $linkPage .= "&nbsp;<a href='" . str_replace('__PAGE__', $page, $url) . "'>&nbsp;" . $page . "&nbsp;</a>";
                } else {
                    break;
                }
            } else {
                if ($this->totalPages != 1) {
                    $linkPage .= "&nbsp;<span class='current'>" . $page . "</span>";
                }
            }
        }
        $pageStr = str_replace(
                array('%header%', '%nowPage%', '%totalRow%', '%totalPage%', '%upPage%', '%downPage%', '%first%', '%prePage%', '%linkPage%', '%nextPage%', '%end%'), 
                array($this->config['header'], $this->nowPage, $this->totalRows, $this->totalPages, $upPage, $downPage, $theFirst, $prePage, $linkPage, $nextPage, $theEnd), $this->config['theme']);
        return $pageStr;
    }

}

