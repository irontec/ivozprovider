import defaultEntityBehavior, { EntityFormProps, FieldsetGroups } from 'lib/entities/DefaultEntityBehavior';
import _ from 'lib/services/translations/translate';
import useFkChoices from './useFkChoices';

const Form = (props: EntityFormProps): JSX.Element => {

    const DefaultEntityForm = defaultEntityBehavior.Form;
    const fkChoices = useFkChoices();

    const groups: Array<FieldsetGroups> = [
        {
            legend: _('Basic Configuration'),
            fields: [
                'name',
                'timeout',
                'maxDigits',
                'welcomeLocution',
                'successLocution',
            ]
        },
        {
            legend: _('Extension dialing'),
            fields: [
                'allowExtensions',
                'excludedExtensionIds',
            ]
        },
        {
            legend: _('No input configuration'),
            fields: [
                'noInputLocution',
                'noInputRouteType',
                'noInputNumberCountry',
                'noInputNumberValue',
                'noInputExtension',
                'noInputVoiceMailUser',
            ]
        },
        {
            legend: _('Error configuration'),
            fields: [
                'errorLocution',
                'errorRouteType',
                'errorNumberCountry',
                'errorNumberValue',
                'errorExtension',
                'errorVoiceMailUser',
            ]
        },
    ];

    return (<DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />);
}

export default Form;