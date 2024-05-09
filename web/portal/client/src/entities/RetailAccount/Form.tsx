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
        'transport',
        'ip',
        'port',
        'ruriDomain',
        'multiContact',
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
      legend: _('Advanced Configuration'),
      fields: ['fromDomain', 'ddiIn', 't38Passthrough', 'rtpEncryption'],
    },
    {
      legend: _('Status'),
      fields: ['status'],
    },
  ];

  return <DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />;
};

export default Form;
