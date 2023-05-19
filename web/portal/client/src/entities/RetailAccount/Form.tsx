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

  const fkChoices = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
  });

  const groups: Array<FieldsetGroups> = [
    {
      legend: _('Basic Configuration'),
      fields: [
        'name',
        'description',
        'password',
        'directConnectivity',
        'transport',
        'ip',
        'port',
      ],
    },
    {
      legend: _('Outgoing Configuration'),
      fields: ['outgoingDdi'],
    },
    {
      legend: _('Geographic Configuration'),
      fields: ['transformationRuleSet'],
    },
    {
      legend: _('Status'),
      fields: ['status'],
    },
  ];

  return <DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />;
};

export default Form;
