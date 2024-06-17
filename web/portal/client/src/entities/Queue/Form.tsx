import useFkChoices from '@irontec-voip/ivoz-ui/entities/data/useFkChoices';
import {
  EntityFormProps,
  FieldsetGroups,
  Form as DefaultEntityForm,
} from '@irontec-voip/ivoz-ui/entities/DefaultEntityBehavior';
import _ from '@irontec-voip/ivoz-ui/services/translations/translate';
import { useStoreState } from 'store';

import { foreignKeyGetter } from './ForeignKeyGetter';

const Form = (props: EntityFormProps): JSX.Element => {
  const { entityService, row, match, initialValues, create } = props;

  const fkChoices = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
  });

  const aboutMe = useStoreState((state) => state.clientSession.aboutMe.profile);

  if (create) {
    initialValues.timeoutNumberCountry = aboutMe?.defaultCountryId ?? null;
    initialValues.fullNumberCountry = aboutMe?.defaultCountryId ?? null;
  }

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
      fields: [
        'periodicAnnounceLocution',
        'periodicAnnounceFrequency',
        'announcePosition',
        'announceFrequency',
      ],
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
