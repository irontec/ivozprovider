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
  const { entityService, row, match, initialValues, create } = props;
  const fkChoices = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
  });

  const aboutMe = useStoreState((state) => state.clientSession.aboutMe.profile);

  if (create) {
    initialValues.numberCountry = aboutMe?.defaultCountryId ?? null;
  }

  const groups: Array<FieldsetGroups> = [
    {
      legend: _('Entry information'),
      fields: ['entry', 'welcomeLocution', 'displayName'],
    },
    {
      legend: _('Routing configuration'),
      fields: [
        'routeType',
        'numberCountry',
        'numberValue',
        'extension',
        'voicemail',
        'conditionalRoute',
      ],
    },
  ];

  return <DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />;
};

export default Form;
