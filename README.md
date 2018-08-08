# a validator for php form
## 欢迎使用！持续维护！有建议什么的请联系 1069163403@qq.com谢谢！
## 用来验证数据的插件
## 目前拥有的验证器
* Digit 
> 验证数据是否属于数字。包括正负数、浮点数等。
> 特殊选项： []
* Integer
> 验证数据是否属于整数。包括正负数等。
> 特殊选项：[]
* NotEmpty
> 验证某个值是否不为NULL或者不是空字符串。
> 特殊选项：[]

* File
> 验证文件的相关属性。

> 特殊选项：[下面所示]
>>    * maxSize [string]
>>> 文件最大尺寸。可用 :maxSize 替换对应的值    
>>    * messageSize [string]
>>> 尺寸不合法时的自定义信息。占位符[:maxSize] 代表限制的最大size    
>>    * allowType [array]
>>> 允许的文件扩展类型列表
>>    * messageType [string]
>>> 类型不在列表内时的错误信息。占位符[:fileType] 代表上传的文件扩展类型
    
* Callback
> 用户自定义回调函数

> 特殊选项: [下面所示]
>>    * callback [callable]
>>> 回调函数。返回false代表检验失败，其余代表正常

* Regex
> 正则表达式验证函数

> 特殊选项: [下面所示]    
>>    * pattern [string]
>>> 标准正则表达式

*Between
>区域值判定，判定对象为数值

> 特殊选项：[下面所示] 
>>    * min [int]
>>> 最小值【数值】
>>    * max [int]
>>> 最大值【数值】

*StringLength
>字符串长度判定
>特殊选项：[下面所示]
>>    * min [int][默认为0]
>>> 最小值【数值】
>>    * messageMin [string]
>>> 不满足最小值时的提示语
>>    * max [int][默认为无上限]
>>> 最大值
>>    * messageMax [string]
>>> 不满足最大值时的提示语

*ExclusionIn
>值的枚举限定

> 特殊选项：[下面所示]
>>    * domain [array]
>>> 目标值不能够出现在此数组内    

*InclusionIn
>值的枚举限定

> 特殊选项：[下面所示]
>>    * domain [array]
>>> 目标值必须出现在此数组内  

## 选项解释 
> ps:带有 [*] 号的都是通用选项

>   * allowEmpty
>> 允许一个值是空字符串或者为null，默认的验证器都是允许为空，NotEmpty验证器没有这个属性

>   * interruptOnFail [*]
>> 当某个规则失败时，中断下面的校验

>   * message [*]
>> 失败提示符。可用 :field 代表对应的键

>   * code [*]
>> 失败码

## to do list
* 添加验证器初始化函数
* 正则表达式添加常用正则表达式