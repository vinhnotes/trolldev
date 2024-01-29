<template>
  <div>
    <div
      class="vueticol-wrapper"
      :class="style"
      @click="isOpen = !isOpen"
      :style="{ background: selectedColor ? selectedColor : '#dddddd' }"
      v-vueticol-click-outside="close"
    >
      <svg
        v-if="!value"
        class="vueticol-icon"
        stroke-width="1.5"
        viewBox="0 0 24 24"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
        color="#000000"
      >
        <path
          d="M13.879 7.697L16 9.817a1 1 0 010 1.415L8.363 18.87a1.001 1.001 0 01-.326.218L5.54 20.114c-1.233.508-2.466-.725-1.958-1.958L4.61 15.66a.999.999 0 01.218-.327l7.636-7.636a1 1 0 011.415 0zM13.879 3.454L16 5.575m4.243 4.243L18.12 7.697m-2.12-2.122l1.413-1.414a1 1 0 011.414 0l.708.707a1 1 0 010 1.414L18.12 7.697m-2.12-2.122l2.12 2.122"
          stroke="#000000"
          stroke-width="1.5"
          stroke-linecap="round"
          stroke-linejoin="round"
        ></path>
      </svg>

      <div v-if="isOpen" @click.stop class="vueticol-dropdown">
        <div class="vueticol-grid">
          <div
            v-for="color in colors"
            :key="color"
            class="vueticol-color"
            :style="{ background: color }"
            @click="selectedColor = color"
          >
            <svg
              v-if="color === value"
              class="vueticol-check"
              stroke-width="1.5"
              viewBox="0 0 24 24"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
              color="#000000"
            >
              <path
                d="M5 13l4 4L19 7"
                stroke="#000000"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              ></path>
            </svg>
          </div>
        </div>
        <div v-if="value !== ''" @click="selectedColor = ''" class="vueticol-remove">
          {{ removeText }}
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ColorPicker',
  props: {
    modelValue: {
      type: String,
      default: ''
    },
    removeText: {
      type: String,
      default: 'Remove color'
    },
    style: {
      type: String,
      default: 'square'
    },
    colors: {
      type: Array,
      default: () => [
        '#3233ff',
        '#5151ff',
        '#6f70fe',
        '#9998fe',
        '#c3c2fe',
        '#fe0166',
        '#fe277d',
        '#fe4d95',
        '#ff80b5',
        '#feb3d1',
        '#e32a1d',
        '#f54830',
        '#ff6b55',
        '#ff9e8b',
        '#ffcabc',
        '#ffd148',
        '#ffd863',
        '#ffdf7b',
        '#ffe9a3',
        '#fff2c8',
        '#1e8a60',
        '#2db37e',
        '#47d49a',
        '#7fdfb9',
        '#bcefdc',
        '#080726',
        '#24303e',
        '#535b68',
        '#9ba2b4',
        '#c7cfda'
      ]
    }
  },
  data() {
    return {
      isOpen: false,
      value: ''
    }
  },
  mounted() {
    this.value = this.modelValue
  },
  computed: {
    selectedColor: {
      get() {
        return this.value
      },
      set(newValue) {
        this.$emit('update:modelValue', newValue)
        this.isOpen = false
        this.value = newValue
      }
    }
  },
  methods: {
    close() {
      this.isOpen = false
    }
  }
}
</script>

<style lang="css" scoped>
.vueticol-wrapper {
  width: 40px;
  height: 40px;
  position: relative;
  cursor: pointer;
  border: 1px solid #eaeaea;
}
.vueticol-wrapper.square {
  border-radius: 5px;
}
.vueticol-wrapper.circle {
  border-radius: 50%;
}
.vueticol-icon {
  width: 20px;
  height: 20px;
  margin: 10px;
}
.vueticol-dropdown {
  cursor: default;
  position: absolute;
  top: 40px;
  left: 0;
  background: #ffffff;
  padding: 5px;
  border-radius: 5px;
  border: 1px solid #eaeaea;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
}
.vueticol-grid {
  display: grid;
  grid-template-columns: auto auto auto auto auto;
  grid-gap: 3px;
}
.vueticol-color {
  width: 24px;
  height: 24px;
  border-radius: 3px;
  cursor: pointer;
  border: 1px solid #eaeaea;
}
.vueticol-check {
  width: 18px;
  height: 18px;
  margin: 3px;
}
.vueticol-remove {
  font-family: sans-serif;
  font-size: 12px;
  color: #24303e;
  margin-top: 3px;
  padding: 5px;
  border-radius: 3px;
  text-align: center;
  cursor: pointer;
  background: #eeeeee;
}
</style>
