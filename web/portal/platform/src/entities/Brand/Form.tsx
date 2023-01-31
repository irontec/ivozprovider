import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import defaultEntityBehavior, {
  EntityFormProps,
  FieldsetGroups,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import _ from '@irontec/ivoz-ui/services/translations/translate';

const Form = (props: EntityFormProps): JSX.Element => {
  const { entityService, row, match, foreignKeyGetter } = props;

  const DefaultEntityForm = defaultEntityBehavior.Form;
  const fkChoices = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
  });

  const groups: Array<FieldsetGroups | false> = [
    {
      legend: _('Basic Configuration'),
      fields: [
        'name',
        'nif',
        //'proxyTrunks', // TODO:
        'features', // TODO:
        'logo',
        'maxCalls',
      ],
    },
    {
      legend: _('Locales'),
      fields: ['defaultTimezone', 'language', 'currency'],
    },
    {
      legend: _('Domain Sip'),
      fields: ['domainUsers'],
    },
    {
      legend: _('Invoice Data'),
      fields: [
        'postalAddress',
        'postalCode',
        'city',
        'province',
        'country',
        'registerInfo',
      ],
    },
  ];

  return <DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />;
};

export default Form;
