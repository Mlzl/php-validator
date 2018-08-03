# php-validator 
## 用来验证数据的插件
*********
## 目前拥有的验证器
* Digit 
> 验证数据是否属于数字。包括正负数、浮点数等。
>>特殊选项： []
* Integer
> 验证数据是否属于整数。包括正负数等。
>> 特殊选项：[]
* NotEmpty
> 验证某个值是否不为NULL或者不是空字符串。
>> 特殊选项：[]

* File
> 验证文件的相关属性。
> 特殊选项：[下面所示]

    * maxSize [string]
>> 文件最大尺寸。可用 :maxSize 替换对应的值
    
    * messageSize [string]
>> 尺寸不合法时的自定义信息。占位符[:maxSize] 代表限制的最大size
    
    * allowType [array]
>> 允许的文件扩展类型列表

    * messageType [string]
>> 类型不在列表内时的错误信息。占位符[:fileType] 代表上传的文件扩展类型
    
* Callback
> 用户自定义回调函数
>> 特殊选项: [下面所示]
    
    * callback
>> 回调函数。返回false代表检验失败，其余代表正常

* Regex
> 正则表达式验证函数
>> 特殊选项: [下面所示]
    
    * pattern
>> 标准正则表达式

## 选项解释 
> ps:带有 [*] 号的都是通用选项
* allowEmpty
> 允许一个值是空字符串或者为null，默认的验证器都是允许为空，NotEmpty验证器没有这个属性
* interruptOnFail [*]
> 当某个规则失败时，中断下面的校验
* message [*]
> 失败提示符。可用 :field 代表对应的键
* code [*]
> 失败码

## TO DO LIST
* Between
* StringLength
* InclusionIn
* ExclusionIn
* https://docs.phalconphp.com/en/3.3/validation
