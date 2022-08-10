import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import defaultEntityBehavior, {
  EntityFormProps,
  FieldsetGroups,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import { foreignKeyGetter } from './ForeignKeyGetter';

const Form = (props: EntityFormProps): JSX.Element => {
  const { entityService, row, match } = props;
  const DefaultEntityForm = defaultEntityBehavior.Form;
  const fkChoices = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
  });

  const groups: Array<FieldsetGroups | false> = [
    {
      legend: _('Main'),
      fields: [
        'type',
        'name',
        'domainUsers',
        'nif',
        'maxCalls',
        'maxDailyUsage',
        'maxDailyUsageEmail',
        'postalAddress',
        'postalCode',
        'town',
        'province',
        'countryName',
        'ipfilter',
        'onDemandRecord',
        'onDemandRecordCode',
        'externallyextraopts',
        'billingMethod',
        'balance',
        'showInvoices',
        'id',
        'language',
        'defaultTimezone',
        'country',
        'currency',
        'transformationRuleSet',
        'outgoingDdi',
        'voicemailNotificationTemplate',
        'faxNotificationTemplate',
        'invoiceNotificationTemplate',
        'callCsvNotificationTemplate',
        'featureIds',
      ],
    },
  ];

  return <DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />;
};

export default Form;
