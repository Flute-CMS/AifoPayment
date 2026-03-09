@php
    $settings = $gateway ? $gateway->getSettings() : [];
    if (empty($settings)) {
        $settings = [
            'shop_id' => null,
            'secret_key' => '',
            'signature_type' => 2, // Default to SHA256
        ];
    }
@endphp

<x-forms.field>
    <x-forms.label for="settings__shop_id" required>Shop ID (ID каси):</x-forms.label>
    <x-fields.input name="settings__shop_id" id="settings__shop_id" type="number"
        value="{{ request()->input('settings__shop_id', $settings['shop_id']) }}"
        placeholder="Введите Shop ID" required />
</x-forms.field>

<x-forms.field>
    <x-forms.label for="settings__secret_key" required>Секретный ключ:</x-forms.label>
    <x-fields.input name="settings__secret_key" id="settings__secret_key" type="password"
        value="{{ request()->input('settings__secret_key', $settings['secret_key']) }}"
        placeholder="Вставьте сюда секретный ключ" required />
</x-forms.field>

<x-forms.field>
    <x-forms.label for="settings__signature_type" required>Тип подписи:</x-forms.label>
    <x-fields.select name="settings__signature_type" id="settings__signature_type" required>
        <option value="1" @selected(request()->input('settings__signature_type', $settings['signature_type']) == 1)>MD5 (Небезопасно, устарело)</option>
        <option value="2" @selected(request()->input('settings__signature_type', $settings['signature_type']) == 2)>SHA256 (Рекомендовано)</option>
        <option value="3" @selected(request()->input('settings__signature_type', $settings['signature_type']) == 3)>SHA1</option>
        <option value="4" @selected(request()->input('settings__signature_type', $settings['signature_type']) == 4)>RIPEMD160</option>
        <option value="5" @selected(request()->input('settings__signature_type', $settings['signature_type']) == 5)>SHA384</option>
        <option value="6" @selected(request()->input('settings__signature_type', $settings['signature_type']) == 6)>SHA512</option>
    </x-fields.select>
</x-forms.field>
