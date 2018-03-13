<?php
/**
 * 数据库封装类 21-1
 */
class DB extends PDO { //此类扩展自 PHP 的 PDO 数据库操作类
	var $sth; //用于存储 PDOStatement 对象

    /**
     * 执行 SQL 语句
     * @param  [type] $sql    [description]
     * @param  array  $values [description]
     * @return [type]         [description]
     */
	function execute($sql, $values = array() ) {
		$this->sth = $this->prepare($sql); //预执行 SQL 语句，可防止 SQL 注入
		return $this->sth->execute($values); //执行 SQL 语句
	}

	/**
	 * 得到所有 SELECT 语句执行后的数据集
	 * @param  [type] $sql    [description]
	 * @param  array  $values [description]
	 * @return [type]         [description]
	 */
	function get_all($sql, $values = array() ) {
		$this->execute($sql, $values); //执行本类的 execute 方法
		return $this->sth->fetchAll(); //取得所有结果集
	}

	/**
	 * 取得一条 SELECT 语句执行后的数据集
	 * @param  [type] $sql    [description]
	 * @param  array  $values [description]
	 * @return [type]         [description]
	 */
	function get_one($sql, $values = array()) {
		$this->execute($sql, $values); //执行本类的 execute 方法
		return $this->sth->fetch(); //取得一条结果集
	}

	/**
	 * 取得记录中的列值
	 * @param  [type]  $sql           [description]
	 * @param  array   $values        [description]
	 * @param  integer $column_number [description]
	 * @return [type]                 [description]
	 */
	function get_col($sql, $values = array(), $column_number = 0) {
		$this->execute($sql, $values); //执行本类的 execute 方法
		return $this->sth->fetchColumn($column_number); //取得结果集中的某一列值
	}

	/**
	 * 向数据表中插入数据
	 * @param  [type] $table [description]
	 * @param  [type] $data  [description]
	 * @return [type]        [description]
	 */
	function insert($table, $data) {
		$fields = array_keys($data); //提取数据中的 key 值
		$marks = array_fill(0, count($fields), '?'); //组成数据
		//重新组合成插入的 SQL 语句
		$sql = "INSERT INTO $table (`" . implode('`,`',$fields) . "`) VALUES (".implode(",",$marks)." )";
		return $this->execute($sql, array_values($data)); //执行本类的 execute 方法，并返回结果
	}
	
	/**
	 * 更新数据表中的数据
	 * @param  [type] $table [description]
	 * @param  [type] $data  [description]
	 * @param  [type] $where [description]
	 * @return [type]        [description]
	 */
	function update($table, $data, $where) {
		$values = $bits = $wheres = array(); //建立数据
		foreach ( $data as $k=>$v) { //循环构建需要的数据参数
			$bits[] = "`$k` = ?";
			$values[] = $v;
		}
		if( is_array( $where ) ) { //循环构建需要的条件参数
			foreach ( $where as $c => $v ) {
				$wheres[] = "$c = ?";
				$values[] = $v;
			}
		}
		else
			return false;
		//重新组合成更新的 SQL 语句
		$sql = "UPDATE $table SET" . implode( ', ', $bits ) . ' WHERE ' . implode( ' AND ', $wheres );
		return $this->execute($sql, $values); //执行本类的 execute 方法，并返回结果
	}

	/**
	 * 从数据表中删除结果集
	 * @param  [type] $table [description]
	 * @param  [type] $field [description]
	 * @param  [type] $where [description]
	 * @return [type]        [description]
	 */
	function delete($table, $field, $where) {
		if( empty($where) ) { //条件是否为空
			return false; //返回 FALSE
		}
		//预执行删除语句
		$this->sth = $this->prepare("DELETE FROM $table WHERE $field = ?");

		if( is_array($where) ) { //如果是数组
			foreach($where as $key=>$val) { //循环需要删除的值
				$this->sth->execute(array($val)); //执行本类的 execute 方法
			}
		} else { //只有一个数值
			$this->sth->execute(array($where)); //执行本类的 execute 方法
		}
	}

	/**
	 * 将数据表导出成 SQL 语句
	 * @param  [type] $table [description]
	 * @return [type]        [description]
	 */
	function table2sql($table) {
		$sql = array(); //创建临时数组
		$sql[] = "DROP TABLE IF EXISTS `{$table}`;\n"; //如果存在则删除该数据表
		$create_table = $this->get_one('SHOW CREATE TABLE '.$table); //返回表结构的 SQL 语句
		$sql[] = $create_table[1].";\n\n"; //将如上语句存入临时数组中
		return implode('', $sql); //以 SQL 形式返回所有的表信息
	}

	/**
	 * 将数据表数据导出成 SQL 语句
	 * @param  [type] $table [description]
	 * @return [type]        [description]
	 */
	function data2sql($table) {
		$sql = array(); //创建临时数组
		$sql[] = "DROP TABLE IF EXISTS `{$table}`;\n"; //如果存在则删除该数据表
		$create_table = $this->get_one('SHOW CREATE TABLE '.$table); //返回表结构的 SQL 语句
		$sql[] = $create_table[1].";\n\n"; //将如上语句存入临时数组中

		$rows = $this->get_all("SELECT * FROM $table"); //取得表中的所有数据
		$col_count = $this->sth->columnCount(); //取得记录的个数

		foreach($rows as $row) { //循环取得的数据
			$sql[] = "INSERT INTO $table VALUES("; //创建 insert 语句
			$comma = '';

			for($i=0; $i< $col_count; $i++) { //循环记录中所有列
				if (!isset($row[$i])) { //如果没有值
					$sql[] = $comma."NULL"; //设置为 NULL
				} else { //否则
					$sql[] = $comma."'".$row[$i]."'"; //设置为当前值
				}
				$comma = ','; //更改连接符为","
			}
			$sql[] = ");\n";
		}
		$sql[] = "\n";
		return implode('', $sql); //以 SQL 形式返回所有的数据信息
	}
	/**
	 * 将数据库中的所有数据表导出成 SQL 形式字符串
	 * @return [type] [description]
	 */
	function dump_sql() {
		$sql = array(); //创建临时数组
		foreach ($this->query('SHOW TABLES') as $row) { //循环所有的表
			$sql[] = $this->data2sql($row[0]); //调用 data2sql 导出数据表的 SQL
		}
		return implode('', $sql); //返回集合后的 SQL 数据
	}

}


?>