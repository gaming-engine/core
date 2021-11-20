import { createApp } from 'vue'
import VirtualForm from '@components/VirtualForm.vue'
import DropDownList from '@components/form/DropDownList.vue'
import InputField from '@components/form/InputField.vue'
import PasswordField from '@components/form/PasswordField.vue'
import FormButton from '@components/form/FormButton.vue'
import ProgressBar from '@components/ProgressBar.vue'

const app = createApp({})
app.component('v-form', VirtualForm)

app.component('drop-down', DropDownList)
app.component('input-field', InputField)
app.component('password-field', PasswordField)
app.component('form-button', FormButton)
app.component('progress-bar', ProgressBar)

app.mount('#app')
