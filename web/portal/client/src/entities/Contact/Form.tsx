import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import {
  EntityFormProps,
  FieldsetGroups,
  foreignKeyGetter,
  Form as DefaultEntityForm,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import _ from '@irontec/ivoz-ui/services/translations/translate';

const Form = (props: EntityFormProps): JSX.Element => {
  const { entityService, row, match } = props;
  const userContact = row?.user !== undefined;

  const fkChoices = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
  });

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
