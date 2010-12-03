A trampoline is a useful device which allows you to utilize the elegance of tail recursion in php w/o converting it to a while loop yourself. The only added syntactic overhead is having to wrap your tail call w/ 
    Trampoline::Bounce(function() use($n) { return tailCallFunc($n); })

For further info check out [http://commonphp.blogspot.com/2010/12/revision-to-php-tco-trampoline.html](http://commonphp.blogspot.com/2010/12/revision-to-php-tco-trampoline.html) 

For my purposes [PHLISP](http://www.github.com/shaunxcode/phlisp) this is an implementation technique for my lisp. However I think it may prove useful for normal php hacking as well, thus this repository.

Here is an example of a classic tail recursive factorial function before and after Trampoline. 

    function fact($n) {
        $product = function($min, $max) use($n, &$product) {
                return $min == $n ?
                        $max :
                        $product(bcadd($min, 1), bcmul($min, $max));
        };

        return $product(1, $n);
    }

    fact(10000); 
    # Fatal error: Allowed memory size of 16777216 bytes exhausted (tried to allocate 9081 bytes)

    function fact($n) {
        $product = function($min, $max) use($n, &$product) {
                return $min == $n ?
                        $max :
                        Trampoline::Bounce(function() use(&$product, $min, $max) {
                                return $product(bcadd($min, 1), bcmul($min, $max));
                        });
        };

        return $product(1, $n);
    }


    echo Trampoline::fact(10000);
    #(very large precision number, w/ no fatal error or blown stack)
