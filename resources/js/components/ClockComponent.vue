<style>

.timeContent{
  font-family: 'Inconsolata', monospace;
  font-size: 15px;
  color: #a9ced0;
}
</style>

<template>
  <div>
    <div class="LCD text-center">
        <p class="timeContent">{{hours}}:{{minutes}}:{{seconds}}</p>
    </div>

    <div class="date borderTop text-center">
        <p class="timeContent">{{date}}</p>
    </div>
  </div>
</template>

<script>


export default {
  name: "DigitalClock",
  props: ['date'],
  data() {
    return {
        hours: 0,
        minutes: 0,
        seconds: 0,
    }
  },
  mounted() {
    setInterval(() => this.setTime(), 1000)
  },
  methods: {
    setTime() {
      const date = new Date();
      let hours = date.getHours();
      let minutes = date.getMinutes();
      let seconds = date.getSeconds();
      hours = hours <= 9 ? `${hours}`.padStart(2, 0) : hours;
      minutes = minutes <= 9 ? `${minutes}`.padStart(2, 0) : minutes;
      seconds = seconds <= 9 ? `${seconds}`.padStart(2, 0) : seconds;
      this.hours = hours;
      this.minutes = minutes;
      this.seconds = seconds;
    }

  }
}
</script>