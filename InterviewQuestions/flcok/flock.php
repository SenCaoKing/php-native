<?php
/**
 * PHP利用文件锁处理高并发
 */
/**
 * 利用 flock() 函数对文件进行加锁（排它锁），实现并发按序进行。
 *
 * flock(file, lock, block)有三个参数。
 * file：已经打开的文件
 * lock：锁的类型
 *      LOCk_SH: 共享锁（读锁）
 *      LOCk_EX: 独占锁定（排它锁，写锁）
 *      LOCk_UN: 解锁
 *      LOCk_NB: 如果希望在文件锁定时阻塞进程，那么加上该参数。
 * block: 设置为true的时候，锁定文件时，会阻止其他进程
 */
class Flcok{
    /**
     * 阻塞模式（后面的进程会一直等待前面的进程执行完毕）
     */
    public function createFlock1(){
        $file = fopen(__DIR__.'/lock.txt', 'w+');
        // 加锁
        if(flock($file, LOCK_EX)){
            //TODO 执行业务代码
            flock($file, LOCK_UN); // 解锁
        }
        // 关闭文件
        fclose($file);
    }

    /**
     * 非阻塞模式（只要当前文件有锁存在，那么直接返回）
     */
    public function createFlock2(){
        $file = fopen(__DIR__.'/lock.txt', 'w+');
        // 加锁
        if(flock($file, LOCK_EX|LOCK_NB)){
            //TODO 执行业务代码
            flock($file, LOCK_UN); // 解锁
        }else{
            //TODO 执行业务代码 返回系统繁忙等错误提示
        }
        // 关闭文件
        fclose($file);
    }
}