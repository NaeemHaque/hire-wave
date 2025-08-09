<x-layout>
    <x-page-heading>Publish  A New Job</x-page-heading>

    <x-forms.form method="POST" action="/jobs">
        <x-forms.input name="title" label="Job Title" placeholder="Full-stack Developer" />
        <x-forms.input name="salary" label="Salary" placeholder="$10,000" />
        <x-forms.input name="location" label="Location" placeholder="Remote" />

        <x-forms.select name="schedule" label="Schedule">
            <option value="Full Time">Full Time</option>
            <option value="Part Time">Part Time</option>
            <option value="Contract">Contract</option>
        </x-forms.select>

        <x-forms.input name="url" label="URL" placeholder="https://example.com" />
        <x-forms.checkbox name="featured" label="Featured" />

        <x-forms.divider />

        <x-forms.textarea name="description" label="Job Description" placeholder="Enter detailed job description, requirements, responsibilities, and benefits..." />

        <x-forms.divider />

        <x-forms.input name="tags" label="Tags(comma separated)" placeholder="Developer, Management, HR" />

        <x-forms.button>Publish</x-forms.button>

    </x-forms.form>

</x-layout>
