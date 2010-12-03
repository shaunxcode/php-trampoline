A trampoline is a useful device which allows you to utilize the elegance of tail recursion in php w/o converting it to a while loop yourself. The only added overhead is having to wrap your tail call w/ Trampoline::Bounce(function() use([any vars you need to close over]) { return tailCallHereFunc($arg1, $arg2); }

For further info check out [http://commonphp.blogspot.com/2010/12/revision-to-php-tco-trampoline.html](http://commonphp.blogspot.com/2010/12/revision-to-php-tco-trampoline.html) 

For my purposes [PHLISP](http://www.github.com/shaunxcode/phlisp) this is an implementation technique for my lisp. However I think it may prove useful for normal php hacking as well, thus this repository.
