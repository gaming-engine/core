import { shallowMount } from '@vue/test-utils'
import FormButton from './FormButton.vue'

describe('form button', () => {
    const sampleProps = {
        disabled: false,
        text: 'hello',
    }

    describe('element properties', () => {
        it('adds the text to the button', () => {
            const wrapper = shallowMount(FormButton, {
                props: sampleProps,
            })

            expect(wrapper.text()).toContain('hello')
        })

        it('marks the button as disabled', () => {
            const { vm } = shallowMount(FormButton, {
                props: {
                    ...sampleProps,
                    disabled: true,
                },
            })

            const { button } = vm.$refs

            expect(button.disabled).toBeTruthy()
        })

        it('styles the component when disabled', () => {
            const wrapper = shallowMount(FormButton, {
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
            const wrapper = shallowMount(FormButton, {
                props: sampleProps,
            })

            expect(wrapper.html()).toContain('hover:bg-gray-200')
            expect(wrapper.html()).toContain('hover:text-gray-600')
        })
    })

    describe('actions', () => {
        it('triggers a click event when clicked on', async () => {
            const wrapper = shallowMount(FormButton, {
                props: sampleProps,
            })

            await wrapper.trigger('click')
            await wrapper.vm.$nextTick()

            expect(wrapper.emitted().click).toBeTruthy()
        })
    })
})
