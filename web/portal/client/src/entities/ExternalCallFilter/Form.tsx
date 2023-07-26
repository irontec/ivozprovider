import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import {
  EntityFormProps,
  FieldsetGroups,
  Form as DefaultEntityForm,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import { useStoreState } from 'store';

import { foreignKeyGetter } from './ForeignKeyGetter';

const Form = (props: EntityFormProps): JSX.Element => {
  const { entityService, row, match } = props;

  const fkChoices = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
  });

  const residential = useStoreState(
    (state) => state.clientSession.aboutMe.profile.residential
  );

  const groups: Array<FieldsetGroups> = [
    {
      legend: _('Basic Info'),
      fields: ['name', !residential && 'welcomeLocution'],
    },
    {
      legend: _('Filtering info'),
      fields: [!residential && 'whiteListIds', 'blackListIds'],
    },
    !residential && {
      legend: _('Holidays configuration'),
      fields: [
        'holidayEnabled',
        'calendarIds',
        'holidayLocution',
        'holidayTargetType',
        'holidayNumberCountry',
        'holidayNumberValue',
        'holidayExtension',
        'holidayVoicemail',
      ],
    },
    !residential && {
      legend: _('Out of schedule configuration'),
      fields: [
        'outOfScheduleEnabled',
        'scheduleIds',
        'outOfScheduleLocution',
        'outOfScheduleTargetType',
        'outOfScheduleNumberCountry',
        'outOfScheduleNumberValue',
        'outOfScheduleExtension',
        'outOfScheduleVoicemail',
      ],
    },
    residential && {
      legend: _('Call forward setting', { count: 2 }),
      fields: [
        'outOfScheduleEnabled',
        'outOfScheduleNumberCountry',
        'outOfScheduleNumberValue',
      ],
    },
  ];

  return <DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />;
};

export default Form;
