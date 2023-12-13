import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import {
  EntityFormProps,
  FieldsetGroups,
  Form as DefaultEntityForm,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import { useStoreState } from 'store';

import { ConditionalRoutesConditionPropertyList } from './ConditionalRoutesConditionProperties';
import { foreignKeyGetter } from './ForeignKeyGetter';

const Form = (props: EntityFormProps): JSX.Element => {
  const { entityService, row, match, initialValues, create } = props;

  const aboutMe = useStoreState((state) => state.clientSession.aboutMe.profile);
  const fkChoices: ConditionalRoutesConditionPropertyList<unknown> =
    useFkChoices({
      foreignKeyGetter,
      entityService,
      row,
      match,
    });

  if (create) {
    initialValues.numberCountry = aboutMe?.defaultCountryId ?? null;
  }

  const groups: Array<FieldsetGroups> = [
    {
      legend: _('Matching priority'),
      fields: ['priority'],
    },
    {
      legend: _('Matching type'),
      fields: ['matchListIds', 'routeLockIds', 'scheduleIds', 'calendarIds'],
    },
    {
      legend: _('Matching handler'),
      fields: [
        'locution',
        'routeType',
        'numberCountry',
        'numberValue',
        'ivr',
        'user',
        'huntGroup',
        'voicemail',
        'friendValue',
        'queue',
        'conferenceRoom',
        'extension',
      ],
    },
  ];

  return <DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />;
};

export default Form;
