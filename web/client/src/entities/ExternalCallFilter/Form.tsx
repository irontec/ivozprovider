import useFkChoices from 'lib/entities/data/useFkChoices';
import defaultEntityBehavior, { EntityFormProps, FieldsetGroups } from 'lib/entities/DefaultEntityBehavior';
import _ from 'lib/services/translations/translate';
import { foreignKeyGetter } from './foreignKeyGetter';

const Form = (props: EntityFormProps): JSX.Element => {

    const { entityService } = props;
    const DefaultEntityForm = defaultEntityBehavior.Form;
    const fkChoices = useFkChoices(foreignKeyGetter, entityService);

    const groups: Array<FieldsetGroups> = [
        {
            legend: _('Basic Info'),
            fields: [
                'name',
                'welcomeLocution',
            ]
        },
        {
            legend: _('Filtering info'),
            fields: [
                'whiteListIds',
                'blackListIds',
            ]
        },
        {
            legend: _('Holidays configuration'),
            fields: [
                'calendarIds',
                'holidayLocution',
                'holidayTargetType',
                'holidayNumberCountry',
                'holidayNumberValue',
                'holidayExtension',
                'holidayVoiceMailUser',
            ]
        },
        {
            legend: _('Out of schedule configuration'),
            fields: [
                'scheduleIds',
                'outOfScheduleLocution',
                'outOfScheduleTargetType',
                'outOfScheduleNumberCountry',
                'outOfScheduleNumberValue',
                'outOfScheduleExtension',
                'outOfScheduleVoiceMailUser',
            ]
        },
    ];

    return (<DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />);
}

export default Form;