/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class RandomString {

#__UPPER = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        #__LOWER = this.#__UPPER.toLowerCase();
        #__DIGITS = "0123456789";
        #__SPECIALS = "#!@~$%^&*)-_";
        #__ALPHANUM = this.#__UPPER + this.#__LOWER + this.#__DIGITS + this.#__SPECIALS;
        #__random
        #__symbols;
        #__buf;
        #__length;
        constructor() {
this.__caller(21);
}

__verifier(__length, __symbols) {
if (__length < 1) {
throw new Error();
}

if (__symbols.length < 2) {
throw new Error();
}

this.#__random = Math.random();
        this.#__symbols = __symbols.split("");
        this.#__length = __length;
        this.#__buf = [];
}

__caller(__length) {
this.__verifier(__length, this.#__ALPHANUM);
}

nextString() {

for (var index = 0, __length = this.#__symbols.length; index < this.#__length; index++) {
this.#__buf[index] = this.#__symbols[Math.floor(Math.random() * __length)];
}
return this.#__buf.join('');
}

}

