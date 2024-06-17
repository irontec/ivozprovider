import useFkChoices from '@irontec-voip/ivoz-ui/entities/data/useFkChoices';
import {
  EntityFormProps,
  FieldsetGroups,
  Form as DefaultEntityForm,
} from '@irontec-voip/ivoz-ui/entities/DefaultEntityBehavior';
import _ from '@irontec-voip/ivoz-ui/services/translations/translate';
import { useStoreState } from 'store';

import { ConditionalRoutePropertyList } from './ConditionalRouteProperties';
import { foreignKeyGetter } from './ForeignKeyGetter';

const Form = (props: EntityFormProps): JSX.Element => {
  const { entityService, row, match, initialValues, create } = props;

  const aboutMe = useStoreState((state) => state.clientSession.aboutMe.profile);

  const fkChoices: ConditionalRoutePropertyList<unknown> = useFkChoices({
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
      legend: _('Basic Configuration'),
      fields: ['name'],
    },
    {
      legend: _('No matching condition handler'),
      fields: [
        'locution',
        'routetype',
        'ivr',
        'huntGroup',
        'voicemail',
        'user',
        'numberCountry',
        'numbervalue',
        'friendvalue',
        'queue',
        'conferenceRoom',
        'extension',
      ],
    },
  ];

  return <DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />;
};

export default Form;
