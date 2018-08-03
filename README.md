# php-validator 
## 用来验证数据的插件
*********
## 目前拥有的验证器
* Digit 
> 验证数据是否属于数字。包括正负数、浮点数等。

>特殊选项： [allowEmpty]
* Integer
> 验证数据是否属于整数。包括正负数等。

> 特殊选项：[allowEmpty]
* NotEmpty
> 验证某个值是否不为NULL或者不是空字符串。

> 特殊选项：[]

* File
> 验证文件的相关属性。

> 特殊选项：[]

    * maxSize [string]
>> 文件最大尺寸。可用 :maxSize 替换对应的值
    
    * messageSize [string]
>> 尺寸不合法时的自定义信息。占位符[:maxSize] 代表限制的最大size
    
    * allowType [array]
>> 允许的文件扩展类型列表

    * messageType [string]
>> 类型不在列表内时的错误信息。占位符[:fileType] 代表上传的文件扩展类型
    
## 选项解释 
> ps:带有 [*] 号的都是通用选项
* allowEmpty
> 允许一个值是空字符串或者为null
* interruptOnFail [*]
> 当某个规则失败时，中断下面的校验
* message [*]
> 失败提示符。可用 :field 代表对应的键
* code [*]
> 失败码
