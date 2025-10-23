import withCustomComponentWrapper, {
  PropertyCustomFunctionComponent,
  PropertyCustomFunctionComponentProps,
} from '@irontec/ivoz-ui/services/form/Field/CustomComponentWrapper';
import React from 'react';

import { OutgoingDdiRulesPatternPropertyList } from '../OutgoingDdiRulesPatternProperties';

type OutgoingDdiRulesPatternValues = OutgoingDdiRulesPatternPropertyList<
  string | number | Record<string, string | number>
>;
type RuleGhostType = PropertyCustomFunctionComponent<
  PropertyCustomFunctionComponentProps<OutgoingDdiRulesPatternValues>
>;

const Rule: RuleGhostType = (props): JSX.Element | null => {
  const { values } = props;
  const { type, prefix, matchList } = values;

  if (type === 'destination') {
    const matchListItem = matchList as Record<string, string>;
    if (!matchListItem) {
      return null;
    }

    return <span>{matchListItem.name as React.ReactNode}</span>;
  }

  return <span>{prefix as React.ReactNode}</span>;
};

export default withCustomComponentWrapper<OutgoingDdiRulesPatternValues>(Rule);
