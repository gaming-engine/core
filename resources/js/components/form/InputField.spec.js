import { shallowMount } from '@vue/test-utils'
import InputField from './InputField.vue'

describe('input field', () => {
    const sampleProps = {
        id: 'foo',
        disabled: false,
        description: 'hello',
        label: 'testing',
        modelValue: '',
        required: false,
    }

    describe('element properties', () => {
        it('adds the text to the button', () => {
            const wrapper = shallowMount(InputField, {
                props: sampleProps,
            })

            expect(wrapper.text()).toContain('hello')
        })

        it('marks the button as disabled', () => {
            const { vm } = shallowMount(InputField, {
                props: {
                    ...sampleProps,
                    disabled: true,
                },
            })

            const { field } = vm.$refs

            expect(field.disabled).toBeTruthy()
        })

        it('styles the component when disabled', () => {
            const wrapper = shallowMount(InputField, {
                props: {
                    ...sampleProps,
                    disabled: true,
                },
            })

            expect(wrapper.html()).toContain('disabled')
            expect(wrapper.html()).toContain('bg-gray-100')
            expect(wrapper.html()).toContain('cursor-not-allowed')
        })

        it('styles the component when enabled', () => {
            const wrapper = shallowMount(InputField, {
                props: sampleProps,
            })

            expect(wrapper.html()).not.toContain('disabled')
        })
    })

    describe('hydrates the input', () => {
        it('selects the proper value to start', () => {
            const wrapper = shallowMount(InputField, {
                props: {
                    ...sampleProps,
                    modelValue: '10',
                },
            })

            const element = wrapper.vm.$refs.field

            expect(element.value).toEqual('10')
            expect(wrapper.vm.value).toEqual('10')
        })

        it('fires an update event when a new value is set', async () => {
            const wrapper = shallowMount(InputField, {
                props: {
                    ...sampleProps,
                    modelValue: '10',
                },
            })

            wrapper.vm.value = '20'
            await wrapper.vm.$nextTick()

            expect(wrapper.emitted()['update:modelValue']).toBeTruthy()
        })

        it('automatically updates if the value is updated externally', async () => {
            const wrapper = shallowMount(InputField, {
                props: {
                    ...sampleProps,
                    modelValue: '10',
                },
            })

            wrapper.setProps({
                modelValue: '20',
            })
            await wrapper.vm.$nextTick()
            expect(wrapper.vm.value).toBe('20')
        })

        it('does nothing if the outside value matches the inside value', async () => {
            const wrapper = shallowMount(InputField, {
                props: {
                    ...sampleProps,
                    modelValue: '10',
                },
            })

            wrapper.setProps({
                modelValue: '10',
            })

            wrapper.setData({
                value: '10',
            })

            await wrapper.vm.$nextTick()
            expect(wrapper.vm.value).toBe('10')
        })
    })
})
