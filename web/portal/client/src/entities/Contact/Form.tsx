import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import defaultEntityBehavior, {
  EntityFormProps,
  FieldsetGroups,
  foreignKeyGetter,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import _ from '@irontec/ivoz-ui/services/translations/translate';

const Form = (props: EntityFormProps): JSX.Element => {
  const { entityService, row, match } = props;
  const userContact = row?.user != undefined;

  const DefaultEntityForm = defaultEntityBehavior.Form;
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
