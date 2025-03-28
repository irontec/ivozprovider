import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import {
  EntityFormProps,
  FieldsetGroups,
  foreignKeyGetter,
  Form as DefaultEntityForm,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import { useStoreState } from 'store';

const Form = (props: EntityFormProps): JSX.Element => {
  const { entityService, row, match, initialValues, create } = props;
  const edit = props.edit || false;
  const isEditable = row?.user !== null && edit;

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
    name: isEditable,
    lastname: isEditable,
    email: isEditable,
    otherPhone: isEditable,
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
