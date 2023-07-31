<?php
// +----------------------------------------------------------------------
// | 海豚PHP框架 [ DolphinPHP ]
// +----------------------------------------------------------------------
// | 版权所有 2016~2019 广东卓锐软件有限公司 [ http://www.zrthink.com ]
// +----------------------------------------------------------------------
// | 官方网站: http://dolphinphp.com
// +----------------------------------------------------------------------
namespace tobycroft\zbuilder;

use think\Exception;
use think\facade\Env;
use think\facade\Config;
use think\facade\View;

/**
 * 构建器
 * @package app\common\builder
 * @author 蔡伟明 <314013107@qq.com>
 */
class ZBuilder
{
    /**
     * @var array 构建器数组
     * @author 蔡伟明 <314013107@qq.com>
     */
    protected static $builder = [];
    /**
     * @var array 模板参数变量
     */
    protected static $vars = [];
    /**
     * @var string 动作
     */
    protected static $action = '';

    public static $ASSETS_PATH = '/static/zbuilder/';
    /**
     * 创建各种builder的入口
     * @param string $type 构建器名称，'Form', 'Table', 'View' 或其他自定义构建器
     * @param string $action 动作
     * @return table\Builder|form\Builder\Builder
     * @throws Exception
     * @author 蔡伟明 <314013107@qq.com>
     */
    public static function make($type = '', $action = '')
    {
        if ($type == '') {
            throw new Exception('未指定构建器名称', 8001);
        } else {
            $type = strtolower($type);
        }
        // 构造器类路径
        $class = '\\tobycroft\\zbuilder\\' . $type . '\\Builder';
        if (!class_exists($class)) {
            throw new Exception($type . '构建器不存在', 8002);
        }
        if ($action != '') {
            static::$action = $action;
        } else {
            static::$action = '';
        }
        return new $class;
    }

    protected static $assets = [
        'core_js' => [ // 默认加载
            '<script src="__ZBUILDER_JS__/core/jquery.min.js"></script>',
            '<script src="__ZBUILDER_JS__/core/bootstrap.min.js"></script>',
            '<script src="__ZBUILDER_JS__/core/jquery.slimscroll.min.js"></script>',
            '<script src="__ZBUILDER_JS__/core/jquery.scrollLock.min.js"></script>',
            '<script src="__ZBUILDER_JS__/core/jquery.appear.min.js"></script>',
            '<script src="__ZBUILDER_JS__/core/jquery.countTo.min.js"></script>',
            '<script src="__ZBUILDER_JS__/core/jquery.placeholder.min.js"></script>',
            '<script src="__ZBUILDER_JS__/core/js.cookie.min.js"></script>',
            '<script src="__LIBS__/magnific-popup/magnific-popup.min.js"></script>',
            '<script src="__ZBUILDER_JS__/app.js"></script>',
            '<script src="__ZBUILDER_JS__/dolphin.js"></script>',
            '<script src="__ZBUILDER_JS__/builder/form.js"></script>',
            '<script src="__ZBUILDER_JS__/builder/aside.js"></script>',
            '<script src="__ZBUILDER_JS__/builder/table.js"></script>',
        ],
        'core_css' => [ // 默认加载
            '<link rel="stylesheet" href="__LIBS__/magnific-popup/magnific-popup.min.css">',
            '<link rel="stylesheet" href="__ZBUILDER_CSS__/admin/css/bootstrap.min.css">',
            '<link rel="stylesheet" href="__ZBUILDER_CSS__/admin/css/oneui.css">',
            '<link rel="stylesheet" href="__ZBUILDER_CSS__/admin/css/dolphin.css">',
        ],
        'libs_js' => [ // 默认加载
            '<script src="__LIBS__/bootstrap-notify/bootstrap-notify.min.js"></script>',
            '<script src="__LIBS__/sweetalert/sweetalert.min.js"></script>',
        ],
        'libs_css' => [ // 默认加载
            '<link rel="stylesheet" href="__LIBS__/sweetalert/sweetalert.min.css">',
        ],
        'datepicker_js' => [ // 日期选择
            '<script src="__LIBS__/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>',
            '<script src="__LIBS__/bootstrap-datepicker/locales/bootstrap-datepicker.zh-CN.min.js"></script>',
        ],
        'datepicker_css' => [ // 日期选择
            '<link rel="stylesheet" href="__LIBS__/bootstrap-datepicker/bootstrap-datepicker3.min.css">',
        ],
        'datetimepicker_js' => [ // 日期时间选择
            '<script src="__LIBS__/bootstrap-datetimepicker/moment.min.js"></script>',
            '<script src="__LIBS__/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>',
            '<script src="__LIBS__/bootstrap-datetimepicker/locale/zh-cn.js"></script>',
        ],
        'moment_js' => [
            '<script src="__LIBS__/bootstrap-datetimepicker/moment.min.js"></script>',
        ],
        'datetimepicker_css' => [ // 日期时间选择
            '<link rel="stylesheet" href="__LIBS__/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css"'
        ],
        'webuploader_js' => [ // 文件或图片上传
            '<script src="__LIBS__/webuploader/webuploader.min.js"></script>',
        ],
        'webuploader_css' => [ // 文件或图片上传
            '<link rel="stylesheet" href="__LIBS__/webuploader/webuploader.css">',
        ],
        'select2_js' => [ // 下拉框
            '<script src="__LIBS__/select2/select2.full.min.js"></script>',
            '<script src="__LIBS__/select2/i18n/zh-CN.js"></script>',
        ],
        'select2_css' => [ // 下拉框
            '<link rel="stylesheet" href="__LIBS__/select2/select2.min.css">',
            '<link rel="stylesheet" href="__LIBS__/select2/select2-bootstrap.min.css">',
        ],
        'tags_js' => [ // 标签
            '<script src="__LIBS__/jquery-tags-input/jquery.tagsinput.min.js"></script>',
        ],
        'tags_css' => [ // 标签
            '<link rel="stylesheet" href="__LIBS__/jquery-tags-input/jquery.tagsinput.min.css">',
        ],
        'validate_js' => [ // 验证
            '<script src="__LIBS__/jquery-validation/jquery.validate.min.js"></script>',
        ],
        'editable_js' => [ // 快速编辑
            '<script src="__LIBS__/bootstrap3-editable/js/bootstrap-editable.js"></script>',
        ],
        'editable_css' => [ // 快速编辑
            '<link rel="stylesheet" href="__LIBS__/bootstrap3-editable/css/bootstrap-editable.css">',
        ],
        'colorpicker_js' => [ // 取色器
            '<script src="__LIBS__/bootstrap-colorpicker/bootstrap-colorpicker.min.js"></script>',
        ],
        'colorpicker_css' => [ // 取色器
            '<link rel="stylesheet" href="__LIBS__/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">',
        ],
        'editormd_js' => [ // markdown编辑器
            '<script src="__LIBS__/editormd/editormd.min.js"></script>',
        ],
        'jcrop_js' => [ // 图片裁剪
            '<script src="__LIBS__/jcrop/js/Jcrop.min.js"></script>',
        ],
        'jcrop_css' => [ // 图片裁剪
            '<link rel="stylesheet" href="__LIBS__/jcrop/css/Jcrop.min.css">',
        ],
        'masked_inputs_js' => [ // 格式文本
            '<script src="__LIBS__/masked-inputs/jquery.maskedinput.min.js"></script>',
        ],
        'rangeslider_js' => [ // 范围
            '<script src="__LIBS__/ion-rangeslider/js/ion.rangeSlider.min.js"></script>',
        ],
        'rangeslider_css' => [ // 范围
            '<link rel="stylesheet" href="__LIBS__/ion-rangeslider/css/ion.rangeSlider.min.css">',
            '<link rel="stylesheet" href="__LIBS__/ion-rangeslider/css/ion.rangeSlider.skinHTML5.min.css">',
        ],
        'nestable_js' => [ // 拖拽排序
            '<script src="__LIBS__/jquery-nestable/jquery.nestable.js"></script>',
        ],
        'nestable_css' => [ // 拖拽排序
            '<link rel="stylesheet" href="__LIBS__/jquery-nestable/jquery.nestable.css">',
        ],
        'wangeditor_js' => [ // wang编辑器
            '<script src="__LIBS__/wang-editor/js/wangEditor.min.js"></script>',
        ],
        'wangeditor_css' => [ // wang编辑器
            '<link rel="stylesheet" href="__LIBS__/wang-editor/css/wangEditor.min.css">',
        ],
        'summernote_js' => [ // summernote编辑器
            '<script src="__LIBS__/summernote/summernote.min.js"></script>',
            '<script src="__LIBS__/summernote/lang/summernote-zh-CN.js"></script>',
        ],
        'summernote_css' => [ // summernote编辑器
            '<link rel="stylesheet" href="__LIBS__/summernote/summernote.min.css">',
        ],
        'jqueryui_js' => [ // jqueryui
            '<script src="__LIBS__/jquery-ui/jquery-ui.min.js"></script>',
        ],
        'daterangepicker_js' => [ // 日期时间范围
            '<script src="__LIBS__/bootstrap-daterangepicker/daterangepicker.js"></script>',
        ],
        'daterangepicker_css' => [ // 日期时间范围
            '<link rel="stylesheet" href="__LIBS__/bootstrap-daterangepicker/daterangepicker.css">',
        ]
    ];

    public static $is_admin = 'admin';

    public static function is_admin($is_admin)
    {
        self::$is_admin = $is_admin;
    }

    public static function load_assets()
    {

        $view                                     = config('view');
        $view['tpl_replace_string']['__STATIC__'] = self::$ASSETS_PATH;
        // 文件上传目录
        $view['tpl_replace_string']['__UPLOADS__'] = self::$ASSETS_PATH . '/uploads';
        // JS插件目录
        $view['tpl_replace_string']['__LIBS__'] = self::$ASSETS_PATH . 'libs';
        // 后台CSS目录
        $view['tpl_replace_string']['__ZBUILDER_CSS__'] = self::$ASSETS_PATH . 'zbuilder/css';
        // 后台JS目录
        $view['tpl_replace_string']['__ZBUILDER_JS__'] = self::$ASSETS_PATH . 'zbuilder/js';
        // 后台IMG目录
        $view['tpl_replace_string']['__ZBUILDER_IMG__'] = self::$ASSETS_PATH . 'zbuilder/img';
        // 表单项扩展目录
        $view['tpl_replace_string']['__EXTEND_FORM__'] = self::$ASSETS_PATH . 'form';

        Config::set($view, 'view');

        $tpl_replace_string =  Config::get('view.tpl_replace_string');
        $new_assets = [];
        foreach (self::$assets as $key => $items) {

            $str = '';
            foreach ($items as $value) {
                $str .= str_replace(array_keys($tpl_replace_string), array_values($tpl_replace_string), $value) . PHP_EOL;
            }
            $new_assets[$key] = $str;
        }

        View::assign('assets', $new_assets);
    }


    public function dolphin($_vars)
    {

        View::assign('_icons', [['id'=>'','name'=>'','url'=>'','html'=>'<p class="text-center text-muted">暂无图标</p>']]);
        $tpl_replace_string =  Config::get('view.tpl_replace_string');
        $is_admin = self::$is_admin;
        $dolphin = [
            'top_menu_url' => '',
            'editormd_mudule_path' =>  str_replace(array_keys($tpl_replace_string), array_values($tpl_replace_string), '__LIBS__/editormd/lib/'),
            'wangeditor_emotions' => str_replace(array_keys($tpl_replace_string), array_values($tpl_replace_string), "__LIBS__/wang-editor/emotions.data"),
            'WebUploader_swf' => str_replace(array_keys($tpl_replace_string), array_values($tpl_replace_string), '__LIBS__/webuploader/Uploader.swf'),

            'theme_url' => (string)url("attachment/ajax/setTheme"),
            'jcrop_upload_url' => (string)url("attachment/{$is_admin}.attachment/upload", ["dir" => "images", "from" => "jcrop", "module" => app("http")->getName()]),
            'editormd_upload_url' => (string)url("attachment/{$is_admin}.attachment/upload", ["dir" => "images", "from" => "editormd", "module" => app("http")->getName()]),
            'ueditor_upload_url' => (string)url("attachment/{$is_admin}.attachment/upload", ["dir" => "images", "from" => "ueditor", "module" => app("http")->getName()]),
            'wangeditor_upload_url' => (string)url("attachment/{$is_admin}.attachment/upload", ["dir" => "images", "from" => "wangeditor", "module" => app("http")->getName()]),
            'ckeditor_img_upload_url' => (string)url("attachment/{$is_admin}.attachment/upload", ["dir" => "images", "from" => "ckeditor", "module" => app("http")->getName()]),
            'file_upload_url' => (string)url("attachment/{$is_admin}.attachment/upload", ["dir" => "files", "module" => app("http")->getName()]),
            'image_upload_url' => (string)url("attachment/{$is_admin}.attachment/upload", ["dir" => "images", "module" => app("http")->getName()]),
            'upload_check_url' => (string)url("attachment/ajax/check"),
            'get_level_data' => (string)url("attachment/ajax/getLevelData"),
            'quick_edit_url' => (string)url("quickEdit"),
            'aside_edit_url' => (string)url("attachment/system/quickEdit"),
            'triggers' => isset($_vars['field_triggers']) ? $_vars['field_triggers'] : [], // 触发器集合
            'field_hide' => isset($_vars['field_hide']) ? $_vars['field_hide'] : '', // 需要隐藏的字段
            'field_values' => isset($_vars['field_values']) ? $_vars['field_values'] : '',
            'validate' => isset($_vars['validate']) ? $_vars['validate'] : '', // 验证器
            'validate_fields' => isset($_vars['validate_fields']) ? $_vars['validate_fields'] : '', // 验证字段
            'search_field' => request()->param('search_field', ''), // 搜索字段
            // 字段过滤
            '_filter' => request()->param('_filter') ? request()->param('_filter') : (isset($this->_vars['_filter']) ? $_vars['_filter'] : ""),
            '_filter_content' => request()->param('_filter_content') == '' ? (isset($this->_vars['_filter_content']) ?  $_vars['_filter_content'] : "") :  request()->param('_filter_content'),
            '_field_display' => request()->param('_field_display') ? request()->param('_field_display') : (isset($this->_vars['_field_display']) ? $_vars['_field_display'] : ""),
            '_field_clear' => json_encode(isset($this->_vars['field_clear']) ? $_vars['field_clear'] : []),
            'get_filter_list' => (string)url("attachment/ajax/getFilterList"),
            'curr_url' => (string)url("", request()->route()),
            'curr_params' => request()->param(),
            'layer' => config("zbuilder.pop"),
        ];

        $dolphin = array_merge($dolphin, Config::get('zbuilder.view'));

        $dolphin = json_encode($dolphin, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        View::assign('dolphin', $dolphin);
    }

    /**
     * 格式化字节大小
     * @param  number $size      字节数
     * @param  string $delimiter 数字和单位分隔符
     * @return string            格式化后的带单位的大小
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    static  function format_bytes($size = 0, $delimiter = '')
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
        for ($i = 0; $size >= 1024 && $i < 5; $i++) {
            $size /= 1024;
        }
        return round($size, 2) . $delimiter . $units[$i];
    }

    /**
     * 时间戳格式化
     * @param string $time 时间戳
     * @param string $format 输出格式
     * @return false|string
     */
    static function format_time($time = '', $format = 'Y-m-d H:i')
    {
        return !$time ? '' : date($format, intval($time));
    }

    /**
     * 使用bootstrap-datepicker插件的时间格式来格式化时间戳
     * @param null $time 时间戳
     * @param string $format bootstrap-datepicker插件的时间格式 https://bootstrap-datepicker.readthedocs.io/en/stable/options.html#format
     * @author 蔡伟明 <314013107@qq.com>
     * @return false|string
     */
    static function format_date($time = null, $format = 'yyyy-mm-dd')
    {
        $format_map = [
            'yyyy' => 'Y',
            'yy'   => 'y',
            'MM'   => 'F',
            'M'    => 'M',
            'mm'   => 'm',
            'm'    => 'n',
            'DD'   => 'l',
            'D'    => 'D',
            'dd'   => 'd',
            'd'    => 'j',
        ];

        // 提取格式
        preg_match_all('/([a-zA-Z]+)/', $format, $matches);
        $replace = [];
        foreach ($matches[1] as $match) {
            $replace[] = isset($format_map[$match]) ? $format_map[$match] : '';
        }

        // 替换成date函数支持的格式
        $format = str_replace($matches[1], $replace, $format);
        $time = $time === null ? time() : intval($time);
        return date($format, $time);
    }


    /**
     * 使用momentjs的时间格式来格式化时间戳
     * @param null $time 时间戳
     * @param string $format momentjs的时间格式
     * @author 蔡伟明 <314013107@qq.com>
     * @return false|string
     */
    static function format_moment($time = null, $format = 'YYYY-MM-DD HH:mm')
    {
        $format_map = [
            // 年、月、日
            'YYYY' => 'Y',
            'YY'   => 'y',
            //            'Y'    => '',
            'Q'    => 'I',
            'MMMM' => 'F',
            'MMM'  => 'M',
            'MM'   => 'm',
            'M'    => 'n',
            'DDDD' => '',
            'DDD'  => '',
            'DD'   => 'd',
            'D'    => 'j',
            'Do'   => 'jS',
            'X'    => 'U',
            'x'    => 'u',

            // 星期
            //            'gggg' => '',
            //            'gg' => '',
            //            'ww' => '',
            //            'w' => '',
            'e'    => 'w',
            'dddd' => 'l',
            'ddd'  => 'D',
            'GGGG' => 'o',
            //            'GG' => '',
            'WW' => 'W',
            'W'  => 'W',
            'E'  => 'N',

            // 时、分、秒
            'HH'  => 'H',
            'H'   => 'G',
            'hh'  => 'h',
            'h'   => 'g',
            'A'   => 'A',
            'a'   => 'a',
            'mm'  => 'i',
            'm'   => 'i',
            'ss'  => 's',
            's'   => 's',
            //            'SSS' => '[B]',
            //            'SS'  => '[B]',
            //            'S'   => '[B]',
            'ZZ'  => 'O',
            'Z'   => 'P',
        ];

        // 提取格式
        preg_match_all('/([a-zA-Z]+)/', $format, $matches);
        $replace = [];
        foreach ($matches[1] as $match) {
            $replace[] = isset($format_map[$match]) ? $format_map[$match] : '';
        }

        // 替换成date函数支持的格式
        $format = str_replace($matches[1], $replace, $format);
        $time = $time === null ? time() : intval($time);
        return date($format, $time);
    }

    /**
     * 获取附件路径
     * 需要自己实现如何通过id获取文件地址
     * @param int $id 附件id
     * @author 蔡伟明 <314013107@qq.com>
     * @return string
     */
    static function get_file_path($id = 0)
    {
        return self::$ASSETS_PATH . 'admin/img/none.png';
    }

    /**
     * 获取图片缩略图路径
     * 需要自己实现如何通过id获取文件地址
     * @param int $id 附件id
     * @author 蔡伟明 <314013107@qq.com>
     * @return string
     */
    static function get_thumb($id = 0)
    {

        return self::$ASSETS_PATH . 'admin/img/none.png';
    }

    /**
     * 根据附件id获取文件名
     * 需要自己实现如何通过id获取文件地址
     * @param string $id 附件id
     * @author 蔡伟明 <314013107@qq.com>
     * @return string
     */
    static function get_file_name($id = '')
    {
        return '没有找到文件';
    }
}
