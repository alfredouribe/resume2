<template>
  <div id="kbd" class="keyboard text-center" >
    <div class="keyboard__row" >
      <div id="Backquote" class="keyboard__key">|</div>
      <div id="Digit1" class="keyboard__key">1</div>
      <div id="Digit2" class="keyboard__key">2</div>
      <div id="Digit3" class="keyboard__key">3</div>
      <div id="Digit4" class="keyboard__key">4</div>
      <div id="Digit5" class="keyboard__key">5</div>
      <div id="Digit6" class="keyboard__key">6</div>
      <div id="Digit7" class="keyboard__key">7</div>
      <div id="Digit8" class="keyboard__key">8</div>
      <div id="Digit9" class="keyboard__key">9</div>
      <div id="Digit0" class="keyboard__key">0</div>
      <div id="Minus" class="keyboard__key">-</div>
      <div id="Equal" class="keyboard__key">=</div>
      <div id="Backspace" class="keyboard__key keyboard__key--w2">←</div>
    </div>
    <div class="keyboard__row">
      <div class="keyboard__key keyboard__key--w1-5">TAB</div>
      <div id="KeyQ" class="keyboard__key">Q</div>
      <div id="KeyW" class="keyboard__key">W</div>
      <div id="KeyE" class="keyboard__key">E</div>
      <div id="KeyR" class="keyboard__key">R</div>
      <div id="KeyT" class="keyboard__key">T</div>
      <div id="KeyY" class="keyboard__key">Y</div>
      <div id="KeyU" class="keyboard__key">U</div>
      <div id="KeyI" class="keyboard__key">I</div>
      <div id="KeyO" class="keyboard__key">O</div>
      <div id="KeyP" class="keyboard__key">P</div>
      <div class="keyboard__key"></div>
      <div class="keyboard__key"></div>
      <div class="keyboard__key keyboard__key--w1-5"></div>
    </div>
    <div class="keyboard__row">
      <div id="CapsLock" class="keyboard__key keyboard__key--w1-75">MAYUS</div>
      <div id="KeyA" class="keyboard__key">A</div>
      <div id="KeyS" class="keyboard__key">S</div>
      <div id="KeyD" class="keyboard__key">D</div>
      <div id="KeyF" class="keyboard__key">F</div>
      <div id="KeyG" class="keyboard__key">G</div>
      <div id="KeyH" class="keyboard__key">H</div>
      <div id="KeyJ" class="keyboard__key">J</div>
      <div id="KeyK" class="keyboard__key">K</div>
      <div id="KeyL" class="keyboard__key">L</div>
      <div class="keyboard__key"></div>
      <div class="keyboard__key"></div>
      <div id="Enter" class="keyboard__key keyboard__key--w2-25">⏎</div>
    </div>
    <div class="keyboard__row">
      <div id="ShiftLeft" class="keyboard__key keyboard__key--w1-25">⇧</div>
      <div class="keyboard__key"></div>
      <div id="KeyZ" class="keyboard__key">Z</div>
      <div id="KeyX" class="keyboard__key">X</div>
      <div id="KeyC" class="keyboard__key">C</div>
      <div id="KeyV" class="keyboard__key">V</div>
      <div id="KeyB" class="keyboard__key">B</div>
      <div id="KeyN" class="keyboard__key">N</div>
      <div id="KeyM" class="keyboard__key">M</div>
      <div class="keyboard__key"></div>
      <div class="keyboard__key"></div>
      <div class="keyboard__key"></div>
      <div id="ShiftRight" class="keyboard__key keyboard__key--w2-75">⇧</div>
    </div>
    <div class="keyboard__row">
      <div class="keyboard__key"></div>
      <div id="ControlLeft" class="keyboard__key">CTRL</div>
      <div id="AltLeft" class="keyboard__key">ALT</div>
      <div id="MetaLeft" class="keyboard__key keyboard__key--w1-25"></div>
      <div id="Space" class="keyboard__key keyboard__key--space">_____</div>
      <div id="MetaRight" class="keyboard__key keyboard__key--w1-25"></div>
      <div id="AltRight" class="keyboard__key">ALT</div>
      <div
        id="ArrowLeft"
        class="keyboard__key keyboard__key--h0-5 keyboard__key-arrow-left"
      >←</div>
      <div
        id="ArrowUp"
        class="keyboard__key keyboard__key--h0-5 keyboard__key-arrow-up"
      >↑</div>
      <div
        id="ArrowDown"
        class="keyboard__key keyboard__key--h0-5 keyboard__key-arrow-down"
      >↓</div>
      <div
        id="ArrowRight"
        class="keyboard__key keyboard__key--h0-5 keyboard__key-arrow-right"
      >→</div>
    </div>
  </div>
</template>

<script>
    export default {
        data() {
            return {
                commands : [],
                newCommand: {
                    command: "",
                    response: "",
                }
            }
        },
        mounted() {
            document.addEventListener("keydown", this.keyDown)
            document.addEventListener("keyup", this.keyUp)
        },
        methods:{
            keyDown: e => {
                let k = event.code
                try {
                    document.getElementById(k).classList.add("keyboard__key--pressed")
                } catch(err) {
                    console.log(err)
                }
            },
            keyUp: e => {
                let k = event.code
                try {
                    document.getElementById(k).classList.remove("keyboard__key--pressed")  
                } catch(err) {
                    console.log(err)
                }
            }
        }
    }
</script>