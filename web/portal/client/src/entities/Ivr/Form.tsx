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
    initialValues.noInputNumberCountry = aboutMe?.defaultCountryId ?? null;
    initialValues.errorNumberCountry = aboutMe?.defaultCountryId ?? null;
  }

  const groups: Array<FieldsetGroups> = [
    {
      legend: _('Basic Configuration'),
      fields: [
        'name',
        'timeout',
        'maxDigits',
        'welcomeLocution',
        'successLocution',
      ],
    },
    {
      legend: _('Extension dialing'),
      fields: ['allowExtensions', 'excludedExtensionIds'],
    },
    {
      legend: _('No input configuration'),
      fields: [
        'noInputLocution',
        'noInputRouteType',
        'noInputNumberCountry',
        'noInputNumberValue',
        'noInputExtension',
        'noInputVoicemail',
      ],
    },
    {
      legend: _('Error configuration'),
      fields: [
        'errorLocution',
        'errorRouteType',
        'errorNumberCountry',
        'errorNumberValue',
        'errorExtension',
        'errorVoicemail',
      ],
    },
  ];

  return <DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />;
};

export default Form;
