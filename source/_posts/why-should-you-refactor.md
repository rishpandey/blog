---
extends: _layouts.post
section: content
title: Why should you refactor?
date: 2020-06-08
description: Pay the technical debt or suffer the consequences.
cover_image: https://images.unsplash.com/photo-1528659882437-b89a74bc157f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2550&q=80
featured: false
categories: [coding, clean-code]
---

You have been working on this feature for a long time. When the client pitched this great new addition, you felt this would take a week. And here you are working on a Saturday and nothing feels right. You start to question everything about your career choices, the impostor syndrome kicks in.

Maybe you are not as great as you think. Highly unlikely but possible.

<br>

## It’s not you, it’s Technical Debt

Martin Fowler defines Technical Debt as,

_“Technical Debt is a metaphor, coined by Ward Cunningham, that frames how to think about dealing with this cruft, thinking of it like a financial debt. The extra effort that it takes to add new features is the interest paid on the debt.”_

Most of our work as programmers is paved by the need of stakeholders. The client usually wants something at the last moment and the conversation ends with, “just get it done before Y (an unimaginable deadline) or we will start loosing money”.

You need to opt for the “quick way”.

This is the curse of our craft, we have to make compromises that we know will come back to bite us (or another one of us) in the ass. These compromises allow us to meet the client’s deadline and save them money for now. Congratulations, the code is a step closer to a maintenance nightmare now.

You will surely be entertained when the next feature request comes in.

A few years go by. You keep adding features, layer upon layers of new code. Everything built upon the same code base, inheriting every misused design pattern and reflecting all your bad design choices. You are at the mercy of technical debt, if the interest rate is low it slow you down by days or weeks. If the rate is high, maybe you can’t even implement the feature without a rewrite.

## Pay the Debt with Refactoring

Martin Fowler again has a solid definition of Refactoring.

_“Refactoring is a disciplined technique for restructuring an existing body of code, altering its internal structure without changing its external behavior.”_

Fear not Padavan, refactoring is the way we can repay this debt. Just like any other loan, we keep paying the debt via refactoring and get to keep our sanity.

To get started just remember the boy scout’s rule. Leave your code better than you found it. Make small, incremental changes that leave the code in a better state than it was found.

You should get started with this by,

- Naming your variables and functions well.
- Extracting each step of logic into a function.
- Keeping it DRY and removing duplicate code.
