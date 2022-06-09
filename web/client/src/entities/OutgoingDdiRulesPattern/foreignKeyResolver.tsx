import { foreignKeyResolverType } from "@irontec/ivoz-ui/entities/EntityInterface";
import entities from "../index";
import { OutgoingDdiRulesPatternPropertiesList } from "./OutgoingDdiRulesPatternProperties";

const foreignKeyResolver: foreignKeyResolverType = async function ({
  data,
}): Promise<OutgoingDdiRulesPatternPropertiesList> {
  const { MatchList, Ddi } = entities;
  const iterable = Array.isArray(data) ? data : [data];

  for (const row of iterable) {
    if (row.matchList && typeof row.matchList !== "string") {
      row.matchListId = row.matchList.id;
      row.matchListLink = MatchList.path + "/" + row.matchList.id + "/update";
      row.matchList = MatchList.toStr(row.matchList);
    }

    if (row.forcedDdi && typeof row.forcedDdi !== "string") {
      row.forcedDdiId = row.forcedDdi.id;
      row.forcedDdiLink = Ddi.path + "/" + row.forcedDdi.id + "/update";
      row.forcedDdi = Ddi.toStr(row.forcedDdi);
    }
  }

  return data;
};

export default foreignKeyResolver;
