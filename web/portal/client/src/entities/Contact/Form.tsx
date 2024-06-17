import useFkChoices from '@irontec-voip/ivoz-ui/entities/data/useFkChoices';
import {
  EntityFormProps,
  FieldsetGroups,
  foreignKeyGetter,
  Form as DefaultEntityForm,
} from '@irontec-voip/ivoz-ui/entities/DefaultEntityBehavior';
import _ from '@irontec-voip/ivoz-ui/services/translations/translate';
import { useStoreState } from 'store';

const Form = (props: EntityFormProps): JSX.Element => {
  const { entityService, row, match, initialValues, create } = props;
  const userContact = row?.user !== undefined;

  const fkChoices = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
  });

  const aboutMe = useStoreState((state) => state.clientSession.aboutMe.profile);

  if (create) {
    initialValues.workPhoneCountry = aboutMe?.defaultCountryId ?? null;
    initialValues.mobilePhoneCountry = aboutMe?.defaultCountryId ?? null;
  }

  const readOnlyProperties = {
    name: userContact,
    lastname: userContact,
    email: userContact,
    otherPhone: userContact,
  };

  const groups: Array<FieldsetGroups> = [
    {
      legend: _('Personal data'),
      fields: ['name', 'lastname', 'email'],
    },
    {
      legend: _('Phones'),
      fields: [
        'workPhoneCountry',
        'workPhone',
        'mobilePhoneCountry',
        'mobilePhone',
        'otherPhone',
      ],
    },
  ];

  return (
    <DefaultEntityForm
      {...props}
      fkChoices={fkChoices}
      groups={groups}
      readOnlyProperties={readOnlyProperties}
    />
  );
};

export default Form;
