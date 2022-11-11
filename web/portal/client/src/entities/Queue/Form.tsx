import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import defaultEntityBehavior, {
  EntityFormProps,
  FieldsetGroups,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import { foreignKeyGetter } from './foreignKeyGetter';

const Form = (props: EntityFormProps): JSX.Element => {
  const { entityService, row, match } = props;

  const DefaultEntityForm = defaultEntityBehavior.Form;
  const fkChoices = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
  });

  const groups: Array<FieldsetGroups> = [
    {
      legend: _('Basic Configuration'),
      fields: ['name', 'weight', 'strategy', 'displayName'],
    },
    {
      legend: _('Members configuration'),
      fields: ['memberCallTimeout', 'memberCallRest', 'preventMissedCalls'],
    },
    {
      legend: _('Announce'),
      fields: ['periodicAnnounceLocution', 'periodicAnnounceFrequency'],
    },
    {
      legend: _('Timeout configuration'),
      fields: [
        'maxWaitTime',
        'timeoutLocution',
        'timeoutTargetType',
        'timeoutExtension',
        'timeoutVoicemail',
        'timeoutNumberCountry',
        'timeoutNumberValue',
      ],
    },
    {
      legend: _('Full Queue configuration'),
      fields: [
        'maxlen',
        'fullLocution',
        'fullTargetType',
        'fullExtension',
        'fullVoicemail',
        'fullNumberCountry',
        'fullNumberValue',
      ],
    },
  ];

  return <DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />;
};

export default Form;
