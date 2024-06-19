import {
  EntityFormProps,
  FieldsetGroups,
  Form as DefaultEntityForm,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import _ from '@irontec/ivoz-ui/services/translations/translate';

const Form = (props: EntityFormProps): JSX.Element => {
  const groups: Array<FieldsetGroups | false> = [
    {
      legend: _('Main'),
      fields: [
        'type',
        'name',
        'domainUsers',
        'onDemandRecordCode',
        'balance',
        'id',
        'invoicing',
        'language',
        'defaultTimezone',
        'country',
        'transformationRuleSet',
        'outgoingDdi',
        'outgoingDdiRule',
        'domainName',
      ],
    },
  ];

  return <DefaultEntityForm {...props} groups={groups} />;
};

export default Form;
