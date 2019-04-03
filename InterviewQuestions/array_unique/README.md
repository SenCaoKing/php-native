#### array_unique什么意思？
array_unique —— 移除数组中的重复的值.

说明：
array array_unique( array $array[, int $sort_flags = SORT_STRING] )

array_unique() 接受 array 作为输入并返回没有重复值的新数组。

注意键名保留不变。array_unique() 先将值作为字符串排序，然后对每个值只保留第一个遇到的键名，接着忽略所有后面的键名。这并不意味着在未排序的 array 中同一个值的第一个出现的键名会被保留。

Note: 当且仅当(string) $elem1 === (string) $elem2 时两个单元被认为相同。就是说，当字符串的表达一样时。第一个单元将被保留。



