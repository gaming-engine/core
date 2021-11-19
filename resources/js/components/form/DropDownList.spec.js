import { shallowMount } from '@vue/test-utils'
import DropDownList from './DropDownList.vue'

describe('drop down list', () => {
    const sampleProps = {
        id: 'foo',
        description: 'hello',
        disabled: false,
        label: 'testing',
        modelValue: '',
        options: [
            {
                value: '10',
                text: 'hi',
            },
            {
                value: '20',
                text: 'bye',
            },
        ],
    }

    describe('description', () => {
        it('shows the description when provided', () => {
            const wrapper = shallowMount(DropDownList, {
                props: sampleProps,
            })

            expect(wrapper.html()).toContain('hello')
            expect(wrapper.html()).toContain('role="note"')
        })

        it('does not contain the description if it is not provided', () => {
            delete sampleProps.description
            const wrapper = shallowMount(DropDownList, {
                props: sampleProps,
            })

            expect(wrapper.html()).not.toContain('hello')
            expect(wrapper.html()).not.toContain('role="note"')
        })
    })

    describe('label', () => {
        it('displays the label', () => {
            const wrapper = shallowMount(DropDownList, {
                props: sampleProps,
            })

            expect(wrapper.html()).toContain('testing')
        })

        it('sets the "for" attribute of the label to the provided id', () => {
            const wrapper = shallowMount(DropDownList, {
                props: sampleProps,
            })

            expect(wrapper.html()).toContain('<label for="foo"')
        })
    })

    describe('drop down list', () => {
        it('sets the "id" of the drop down list', () => {
            const wrapper = shallowMount(DropDownList, {
                props: sampleProps,
            })

            expect(wrapper.find('select')).toBeTruthy()
            expect(wrapper.html()).toContain('<select id="foo"')
        })

        it('marks the drop down as disabled if told to', () => {
            sampleProps.disabled = true
            const wrapper = shallowMount(DropDownList, {
                props: sampleProps,
            })

            expect(wrapper.html()).toContain('disabled')
            expect(wrapper.html()).toContain('bg-gray-100')
            expect(wrapper.html()).toContain('cursor-not-allowed')
        })

        it('marks the drop down as disabled if not told to', () => {
            sampleProps.disabled = false
            const wrapper = shallowMount(DropDownList, {
                props: sampleProps,
            })

            expect(wrapper.html()).not.toContain('disabled')
            expect(wrapper.html()).not.toContain('bg-gray-100')
            expect(wrapper.html()).not.toContain('cursor-not-allowed')
        })
    })

    describe('options', () => {
        it('displays all of the options', () => {
            const wrapper = shallowMount(DropDownList, {
                props: sampleProps,
            })

            const element = wrapper.vm.$refs.select
            const { options } = element

            expect(options.length).toBe(sampleProps.options.length)

            Array.from(options).forEach((option) => {
                const exists = sampleProps.options.find(
                    (p) => p.value === option.value
                )

                expect(exists).toBeTruthy()
                expect(option.text).toBe(exists.text)
            })
        })

        it('selects the proper value to start', () => {
            const wrapper = shallowMount(DropDownList, {
                props: {
                    ...sampleProps,
                    modelValue: '10',
                },
            })

            const element = wrapper.vm.$refs.select
            const { options } = element

            const selected = Array.from(options).find(
                (option) => option.selected
            )

            const notSelected = Array.from(options).find(
                (option) => !option.selected
            )

            expect(selected).toBeTruthy()
            expect(selected.value).toBe('10')

            expect(notSelected).toBeTruthy()
            expect(notSelected.value).toBe('20')
        })

        it('fires an update event when a new value is set', async () => {
            const wrapper = shallowMount(DropDownList, {
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
            const wrapper = shallowMount(DropDownList, {
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
            const wrapper = shallowMount(DropDownList, {
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
